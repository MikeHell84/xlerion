import React, { useEffect, useState } from 'react';

export default function RoadmapModal({ serviceId, serviceName, onClose }) {
    const [content, setContent] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        if (!serviceId) return;
        setLoading(true);
        setError(null);
        // Map serviceId to filename (same keys used earlier)
        const map = {
            'desarrollo-web-movil': 'desarrollo-web-movil.md',
            'software-empresarial': 'software-empresarial.md',
            'transformacion-digital': 'transformacion-digital.md',
            'diseño-branding': 'diseno-branding.md',
            'marketing-digital': 'marketing-digital.md',
            'videojuegos': 'desarrollo-videojuegos.md',
            'modelado-3d': 'modelado-3d.md'
        };

        const filename = map[serviceId] || `${serviceId}.md`;
        // Attempt to fetch the markdown file from /roadmaps/
        fetch(`/roadmaps/${filename}`)
            .then(res => {
                if (!res.ok) throw new Error(`No se encontró roadmap: ${res.status}`);
                return res.text();
            })
            .then(text => {
                setContent(text);
            })
            .catch(err => setError(err.message))
            .finally(() => setLoading(false));
    }, [serviceId]);

    // Minimal markdown -> HTML converter for headings, lists and paragraphs
    const mdToHtml = (md) => {
        if (!md) return '';
        const lines = md.split('\n');
        let html = '';
        let inList = false;
        lines.forEach(raw => {
            const line = raw.trim();
            if (line.startsWith('### ')) {
                if (inList) { html += '</ul>'; inList = false; }
                html += `<h3 class="text-lg font-semibold text-white">${escapeHtml(line.slice(4))}</h3>`;
            } else if (line.startsWith('## ')) {
                if (inList) { html += '</ul>'; inList = false; }
                html += `<h2 class="text-xl font-bold text-[#00e9fa]">${escapeHtml(line.slice(3))}</h2>`;
            } else if (line.startsWith('# ')) {
                if (inList) { html += '</ul>'; inList = false; }
                html += `<h1 class="text-2xl font-bold text-[#00e9fa]">${escapeHtml(line.slice(2))}</h1>`;
            } else if (line.startsWith('- ')) {
                if (!inList) { html += '<ul class="list-disc pl-6 text-gray-300 mb-3">'; inList = true; }
                html += `<li>${escapeHtml(line.slice(2))}</li>`;
            } else if (line === '') {
                if (inList) { html += '</ul>'; inList = false; }
                html += '<p class="my-2"></p>';
            } else {
                if (inList) { html += '</ul>'; inList = false; }
                html += `<p class="text-sm text-gray-300 mb-2">${escapeHtml(line)}</p>`;
            }
        });
        if (inList) html += '</ul>';
        return html;
    };

    const escapeHtml = (unsafe) => {
        return unsafe.replace(/[&<>\"']/g, function (m) {
            switch (m) {
                case '&': return '&amp;';
                case '<': return '&lt;';
                case '>': return '&gt;';
                case '"': return '&quot;';
                case "'": return '&#039;';
                default: return m;
            }
        });
    };

    return (
        <div className="fixed inset-0 z-50 flex items-center justify-center p-6">
            <div className="absolute inset-0 bg-black/60" onClick={onClose} />
            <div className="relative max-w-4xl w-full max-h-[80vh] overflow-auto bg-black/80 border border-gray-700 rounded-lg p-6">
                <div className="flex items-start justify-between mb-4">
                    <div>
                        <h3 className="text-2xl font-bold text-[#00e9fa]">Roadmap — {serviceName}</h3>
                        <p className="text-sm text-gray-400">Sprint planificado y entregables por sprint</p>
                    </div>
                    <button onClick={onClose} className="text-gray-300 hover:text-white">Cerrar ✕</button>
                </div>

                {loading && <p className="text-gray-400">Cargando roadmap...</p>}
                {error && <p className="text-red-400">Error: {error}</p>}

                {!loading && !error && (
                    <div className="prose prose-invert" dangerouslySetInnerHTML={{ __html: mdToHtml(content) }} />
                )}
            </div>
        </div>
    );
}
