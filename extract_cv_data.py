#!/usr/bin/env python3
"""
Extractor de información desde CVs en PDF
Extrae secciones clave para enriquecer el curriculum HTML
"""

import os
import json
import re
from pathlib import Path

# Rutas de CVs a analizar
CV_PATHS = [
    r"X:\Programacion\XlerionWeb\xlerion-site\public\docs\cv\Mike CV 2026\MikeCV2026Espaniol.pdf",
    r"X:\Programacion\XlerionWeb\xlerion-site\public\docs\cv\CV Miguel Rodriguez 2025 Completa\CV Miguel Rodriguez 2025 Completa.pdf",
    r"X:\Programacion\XlerionWeb\xlerion-site\public\docs\cv\Miguel_Rodriguez_CV2024.pdf",
]

# Palabras clave para identificar secciones
SECTION_KEYWORDS = {
    "experience": ["Experiencia", "Experience", "Experiencia Laboral", "Work Experience"],
    "skills": ["Habilidades", "Skills", "Tecnologías", "Technologies", "Technical Skills"],
    "education": ["Educación", "Education", "Formación", "Training"],
    "certifications": ["Certificaciones", "Certifications", "Certificados", "Certificates"],
    "profile": ["Perfil", "Profile", "Resumen", "Summary", "Acerca de", "About"],
    "projects": ["Proyectos", "Projects", "Portafolio", "Portfolio"],
}

def extract_cv_info():
    """
    Intenta extraer información básica de los CVs
    Retorna un diccionario con secciones clave
    """
    
    extracted = {
        "experience": [],
        "skills": [],
        "education": [],
        "certifications": [],
        "profile": "",
        "projects": []
    }
    
    try:
        # Intenta usar pdfplumber si está disponible
        try:
            import pdfplumber
            use_pdfplumber = True
        except ImportError:
            use_pdfplumber = False
            print("Advertencia: pdfplumber no disponible, intentando alternativas...")
        
        if use_pdfplumber:
            for pdf_path in CV_PATHS:
                p = Path(pdf_path)
                if not p.exists():
                    print(f"No existe: {pdf_path}")
                    continue
                    
                print(f"\nProcesando: {p.name}")
                
                try:
                    with pdfplumber.open(str(p)) as pdf:
                        full_text = ""
                        for page in pdf.pages:
                            text = page.extract_text() or ""
                            full_text += text + "\n"
                        
                        # Limpiar espacios
                        full_text = re.sub(r'\s+', ' ', full_text)
                        
                        # Extraer secciones simples por búsqueda de palabras clave
                        if "Experiencia" in full_text or "Experience" in full_text:
                            # Encontrar líneas que empiezan con años (2024, 2025, etc)
                            years = re.findall(r'\b(20[12]\d)\b', full_text)
                            if years:
                                extracted["experience"].extend(list(set(years)))
                        
                        # Buscar habilidades
                        skills_section = re.search(r'(Habilidades|Skills)(.*?)(Educacion|Education|$)', full_text, re.IGNORECASE | re.DOTALL)
                        if skills_section:
                            skills_text = skills_section.group(2)
                            # Encontrar palabras técnicas
                            technical_words = re.findall(r'\b([A-Z][a-z]+\d*(?:\s+[A-Z][a-z]+)*)\b', skills_text)
                            extracted["skills"].extend(technical_words[:10])  # Máximo 10
                        
                        print(f"   Procesado con exito")
                        
                except Exception as e:
                    print(f"   Error: {e}")
        
        else:
            print("\nExtraccion manual sin pdfplumber:")
            # Listar los archivos que existen
            for pdf_path in CV_PATHS:
                p = Path(pdf_path)
                if p.exists():
                    size_kb = p.stat().st_size / 1024
                    print(f"   Encontrado: {p.name} ({size_kb:.1f} KB)")
    
    except Exception as e:
        print(f"Error general: {e}")
    
    # Limpiar y deduplicar
    extracted["skills"] = list(set(extracted["skills"]))
    extracted["experience"] = sorted(list(set(extracted["experience"])))
    
    return extracted

def generate_enhancements(extracted_data):
    """
    Genera sugerencias de mejoras para el curriculum basadas en datos extraídos
    """
    
    enhancements = {
        "experience_years": extracted_data["experience"],
        "additional_skills": extracted_data["skills"][:5],
        "suggestions": []
    }
    
    if extracted_data["experience"]:
        enhancements["suggestions"].append(f"Anos de experiencia detectados: {', '.join(extracted_data['experience'])}")
    
    if extracted_data["skills"]:
        enhancements["suggestions"].append(f"Habilidades tecnicas identificadas: {', '.join(extracted_data['skills'][:5])}")
    
    enhancements["suggestions"].append("Recomendacion: Expandir secciones de experiencia con detalles de cada CV")
    enhancements["suggestions"].append("Recomendacion: Agregar metricas de impacto de proyectos")
    
    return enhancements

if __name__ == "__main__":
    print("Extrayendo informacion de CVs...\n")
    
    extracted = extract_cv_info()
    enhancements = generate_enhancements(extracted)
    
    print("\n" + "="*60)
    print("RESUMEN DE EXTRACCION")
    print("="*60)
    print(f"\nAnos detectados: {enhancements['experience_years']}")
    print(f"Skills encontradas: {', '.join(enhancements['additional_skills'][:5])}")
    print(f"\nSugerencias para mejorar el curriculum:")
    for suggestion in enhancements["suggestions"]:
        print(f"   {suggestion}")
    
    # Guardar como JSON para referencia
    output_path = Path("X:/Programacion/XlerionWeb/cv_extracted_data.json")
    with open(output_path, 'w', encoding='utf-8') as f:
        json.dump(enhancements, f, indent=2, ensure_ascii=False)
    
    print(f"\nDatos guardados en: {output_path}")
