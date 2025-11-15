<!-- Partial: non-intrusive chatbot binder -->
<script>
    // Run after DOM ready so #chat-fab and #chat-widget exist
    document.addEventListener('DOMContentLoaded', function(){
        try{
            // Remove any previously injected floating widget (legacy) to avoid duplicates
            const legacy = document.querySelector('#xlerion-chatbot');
            if (legacy && legacy.parentNode) legacy.parentNode.removeChild(legacy);

            // Bind the existing FAB (#chat-fab) to toggle the original chat widget (#chat-widget)
            const fab = document.getElementById('chat-fab');
            const chatWidget = document.getElementById('chat-widget');
            const closeBtn = document.getElementById('close-chat-widget');

            if (!fab) console.debug('[chatbot-binder] #chat-fab not found yet');
            if (!chatWidget) console.debug('[chatbot-binder] #chat-widget not found yet');

            if (fab && chatWidget){
                const toggle = () => {
                    if (chatWidget.classList.contains('hidden')){
                        chatWidget.classList.remove('hidden');
                        chatWidget.style.display = 'flex';
                        requestAnimationFrame(()=>{
                            chatWidget.style.opacity = '1';
                            chatWidget.style.transform = 'scale(1) translateY(0)';
                        });
                    } else {
                        chatWidget.style.opacity = '0';
                        chatWidget.style.transform = 'scale(0.95) translateY(20px)';
                        setTimeout(()=>{
                            chatWidget.classList.add('hidden');
                            chatWidget.style.display = '';
                        }, 200);
                    }
                };

                fab.addEventListener('click', (e)=>{ e.stopPropagation(); toggle(); });
                if (closeBtn) closeBtn.addEventListener('click', (e)=>{ e.stopPropagation(); toggle(); });

                // Debug mode: active on /contacto to trace unexpected hides/toggles
                const isContact = window.location.pathname.toLowerCase().includes('/contacto');
                if (isContact) {
                    console.info('[chatbot-debug] contact page debug enabled');

                    // Log clicks globally to help identify interfering handlers
                    window.addEventListener('click', (ev)=>{
                        console.debug('[chatbot-debug] window click', {target: ev.target, time: Date.now()});
                    }, true);

                    // Observe class mutations on the widget (hidden toggles)
                    const mo = new MutationObserver((list)=>{
                        list.forEach(m => {
                            console.debug('[chatbot-debug] mutation', m);
                        });
                    });
                    mo.observe(chatWidget, { attributes: true, attributeFilter: ['class','style'], attributeOldValue: true });

                    // Expose manual debug helper
                    window.__chatbot_debug = { toggle, chatWidget };
                }
            }
        } catch(e){ console.warn('[chatbot-binder] error', e); }
    });
</script>
