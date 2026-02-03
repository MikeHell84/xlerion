import glob

extensiones = ["*.jpg", "*.jpeg", "*.png", "*.gif", "*.bmp", "*.tiff", "*.webp"]

def buscar_imagenes(ruta):
    imagenes = []
    for ext in extensiones:
        imagenes.extend(glob.glob(ruta + "/**/" + ext, recursive=True))
    return imagenes

ruta_disco = "C:\\Users\\TuUsuario"
imagenes = buscar_imagenes(ruta_disco)

print(f"Se encontraron {len(imagenes)} imágenes")
for img in imagenes:
    print(img)
