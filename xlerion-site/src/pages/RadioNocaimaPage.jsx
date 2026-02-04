import React, { useState, useEffect } from 'react';
import { Radio, Play, MapPin, Users, AlertCircle, ChevronDown } from 'lucide-react';
import Layout from '../components/Layout';
import { useLanguage } from '../context/LanguageContext';

export default function RadioNocaimaPage() {
    const { t } = useLanguage();
    const [demoContent, setDemoContent] = useState(null);
    const [loading, setLoading] = useState(true);
    const [activeTab, setActiveTab] = useState('about');
    const [expandedEvent, setExpandedEvent] = useState(null);

    useEffect(() => {
        // Load demo content from JSON
        fetch('/projects_data/radio_nocaima_demo_content.json')
            .then(res => res.json())
            .then(data => {
                setDemoContent(data);
                setLoading(false);
            })
            .catch(err => {
                console.error('Error loading demo content:', err);
                setLoading(false);
            });
    }, []);

    if (loading || !demoContent) {
        return (
            <Layout>
                <div className="py-40 px-8 max-w-6xl mx-auto text-center">
                    <div className="animate-pulse">
                        <Radio className="mx-auto text-[#00e9fa] mb-4" size={48} />
                        <p className="text-gray-400">{t('radio_nocaima_loading') || 'Cargando...'}</p>
                    </div>
                </div>
            </Layout>
        );
    }

    const { hero, about_section, live_player, episodes_ondemand, events_calendar, correspondents_form, sound_map, support_page, educational_section } = demoContent;

    return (
        <Layout>
            {/* Hero Section */}
            <div className="relative h-[50vh] md:h-[60vh] overflow-hidden bg-black">
                <img
                    src={hero.hero_image_url || '/images/projects/radio-nocaima-hero.jpg'}
                    alt={hero.title}
                    className="absolute inset-0 w-full h-full object-cover"
                    onError={(e) => e.target.style.display = 'none'}
                />
                <div className="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black" />
                <div className="absolute inset-0 flex items-center justify-center">
                    <div className="text-center px-8 max-w-2xl">
                        <div className="flex items-center justify-center gap-3 mb-4">
                            <Radio className="text-[#00e9fa]" size={48} />
                            <span className="inline-block px-3 py-1 bg-[#00e9fa]/20 border border-[#00e9fa] text-[#00e9fa] text-xs font-mono rounded">{t('radio_nocaima_demo_badge') || 'DEMO'}</span>
                        </div>
                        <h1 className="text-4xl md:text-6xl font-black italic uppercase tracking-tighter text-white drop-shadow-2xl mb-4">{hero.title}</h1>
                        <p className="text-lg md:text-xl text-gray-300 mb-8">{hero.subtitle}</p>
                        <div className="flex gap-4 justify-center flex-wrap">
                            <button className="px-6 py-3 bg-[#00e9fa] text-black font-mono text-sm uppercase tracking-wider hover:bg-white transition-colors">
                                {hero.cta_buttons?.[0]?.text || t('radio_nocaima_listen_live') || 'Escuchar en Vivo'}
                            </button>
                            <button className="px-6 py-3 border border-[#00e9fa] text-[#00e9fa] font-mono text-sm uppercase tracking-wider hover:bg-[#00e9fa]/10 transition-colors">
                                {hero.cta_buttons?.[1]?.text || t('radio_nocaima_learn_more') || 'Más Información'}
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {/* Main Content */}
            <div className="py-20 px-8 max-w-6xl mx-auto">
                {/* Tabs Navigation */}
                <div className="flex gap-4 mb-16 overflow-x-auto pb-2 border-b border-white/10">
                    {[
                        { id: 'about', label: t('radio_nocaima_tab_about') || 'Acerca De' },
                        { id: 'player', label: t('radio_nocaima_tab_live') || 'En Vivo' },
                        { id: 'episodes', label: t('radio_nocaima_tab_episodes') || 'Episodios' },
                        { id: 'events', label: t('radio_nocaima_tab_events') || 'Eventos' },
                        { id: 'map', label: t('radio_nocaima_tab_map') || 'Mapa Sonoro' },
                        { id: 'support', label: t('radio_nocaima_tab_support') || 'Apoyar' }
                    ].map(tab => (
                        <button
                            key={tab.id}
                            onClick={() => setActiveTab(tab.id)}
                            className={`px-4 py-2 font-mono text-sm uppercase tracking-wider whitespace-nowrap transition-colors ${activeTab === tab.id
                                    ? 'text-[#00e9fa] border-b-2 border-[#00e9fa]'
                                    : 'text-gray-400 hover:text-white'
                                }`}
                        >
                            {tab.label}
                        </button>
                    ))}
                </div>

                {/* About Tab */}
                {activeTab === 'about' && (
                    <div className="space-y-8">
                        <div>
                            <h2 className="text-3xl font-black uppercase italic mb-4 text-white">{t('radio_nocaima_mission') || 'Nuestra Misión'}</h2>
                            <p className="text-gray-300 text-lg leading-relaxed mb-4">{about_section?.mission_text}</p>
                        </div>
                        <div>
                            <h3 className="text-xl font-mono uppercase tracking-wider mb-4 text-[#00e9fa]">{t('radio_nocaima_stats') || 'Estadísticas'}</h3>
                            <div className="grid md:grid-cols-4 gap-4">
                                {about_section?.stats?.map((stat, idx) => (
                                    <div key={idx} className="p-6 border border-white/10 bg-white/5 rounded-sm text-center">
                                        <div className="text-3xl font-bold text-[#00e9fa] mb-2">{stat.number}</div>
                                        <div className="text-gray-400 text-sm font-mono uppercase">{stat.label}</div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Player Tab */}
                {activeTab === 'player' && (
                    <div className="space-y-8">
                        <div className="p-8 border border-white/10 bg-white/5 rounded-sm">
                            <h2 className="text-2xl font-mono uppercase tracking-wider mb-6 text-[#00e9fa]">{t('radio_nocaima_live_now') || 'Transmisión En Vivo'}</h2>

                            {/* Simple Player UI */}
                            <div className="bg-black/50 p-6 rounded mb-6">
                                <div className="mb-4">
                                    <p className="text-[#00e9fa] font-mono text-sm mb-2">{t('radio_nocaima_current_program') || 'Programa Actual'}</p>
                                    <h3 className="text-2xl font-black text-white">{live_player?.current_program?.name}</h3>
                                    <p className="text-gray-400 text-sm mt-1">{live_player?.current_program?.description}</p>
                                </div>

                                <div className="flex items-center gap-4 mb-6">
                                    <button className="flex items-center justify-center w-16 h-16 bg-[#00e9fa] text-black rounded-full hover:bg-white transition-colors">
                                        <Play size={32} fill="currentColor" />
                                    </button>
                                    <div className="flex-1">
                                        <div className="bg-gray-700 h-2 rounded-full mb-2">
                                            <div className="bg-[#00e9fa] h-2 rounded-full w-1/3" />
                                        </div>
                                        <p className="text-xs text-gray-400">{live_player?.listeners?.current || 0} {t('radio_nocaima_listeners') || 'oyentes'}</p>
                                    </div>
                                </div>

                                <div className="text-xs text-gray-400">
                                    <p className="mb-2">{t('radio_nocaima_stream_info') || 'Transmisión HLS con fallback MP3'}</p>
                                    <p className="text-[#00e9fa]/60">{live_player?.stream_config?.primary_stream}</p>
                                </div>
                            </div>

                            {/* Schedule */}
                            <div>
                                <h3 className="text-lg font-mono uppercase tracking-wider mb-4 text-white">{t('radio_nocaima_daily_schedule') || 'Programación Diaria'}</h3>
                                <div className="space-y-2">
                                    {live_player?.program_schedule?.slice(0, 6).map((program, idx) => (
                                        <div key={idx} className="p-4 border border-white/10 bg-white/5 rounded flex justify-between items-center hover:border-[#00e9fa]/40 transition-colors cursor-pointer">
                                            <div>
                                                <p className="text-white font-mono">{program.time}</p>
                                                <p className="text-gray-400 text-sm">{program.name}</p>
                                            </div>
                                            <div className="text-right">
                                                <p className="text-[#00e9fa] text-sm font-mono">{program.duration}</p>
                                                <p className="text-gray-500 text-xs">{program.host}</p>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                    </div>
                )}

                {/* Episodes Tab */}
                {activeTab === 'episodes' && (
                    <div>
                        <h2 className="text-2xl font-mono uppercase tracking-wider mb-6 text-[#00e9fa]">{t('radio_nocaima_episodes_library') || 'Episodios Disponibles'}</h2>
                        <div className="grid md:grid-cols-3 gap-6">
                            {episodes_ondemand?.episodes?.slice(0, 6).map((episode, idx) => (
                                <div key={idx} className="border border-white/10 bg-white/5 rounded-sm overflow-hidden hover:border-[#00e9fa]/60 transition-colors group cursor-pointer">
                                    <div className="relative overflow-hidden bg-black/50 aspect-video flex items-center justify-center group-hover:bg-black/30 transition-colors">
                                        <Play className="text-[#00e9fa]/50 group-hover:text-[#00e9fa] transition-colors" size={48} />
                                    </div>
                                    <div className="p-4">
                                        <p className="text-[#00e9fa] text-xs font-mono mb-1">{episode.episode_number}</p>
                                        <h3 className="text-white font-mono uppercase text-sm mb-2 line-clamp-2">{episode.title}</h3>
                                        <p className="text-gray-400 text-xs mb-3">{episode.host}</p>
                                        <div className="flex justify-between items-center text-xs text-gray-500">
                                            <span>{episode.duration}min</span>
                                            <span>{episode.play_count} {t('radio_nocaima_plays') || 'reproducciones'}</span>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>
                    </div>
                )}

                {/* Events Tab */}
                {activeTab === 'events' && (
                    <div>
                        <h2 className="text-2xl font-mono uppercase tracking-wider mb-6 text-[#00e9fa]">{t('radio_nocaima_upcoming_events') || 'Próximos Eventos'}</h2>
                        <div className="space-y-3">
                            {events_calendar?.events?.slice(0, 6).map((event, idx) => (
                                <div
                                    key={idx}
                                    className="border border-white/10 bg-white/5 rounded-sm p-4 hover:border-[#00e9fa]/60 transition-colors cursor-pointer"
                                    onClick={() => setExpandedEvent(expandedEvent === idx ? null : idx)}
                                >
                                    <div className="flex gap-4 items-start">
                                        <div className="min-w-24 pt-1">
                                            <p className="text-[#00e9fa] font-mono text-sm font-bold">{event.date}</p>
                                            <p className="text-gray-400 text-xs">{event.time}</p>
                                        </div>
                                        <div className="flex-1">
                                            <h3 className="text-white font-mono uppercase text-sm mb-1">{event.title}</h3>
                                            <p className="text-gray-400 text-sm flex items-center gap-2">
                                                <MapPin size={14} className="text-[#00e9fa]" />
                                                {event.location}
                                            </p>
                                        </div>
                                        <div className="text-[#00e9fa]">
                                            <ChevronDown size={18} className={`transform transition-transform ${expandedEvent === idx ? 'rotate-180' : ''}`} />
                                        </div>
                                    </div>

                                    {expandedEvent === idx && (
                                        <div className="mt-4 pt-4 border-t border-white/10 text-gray-300 text-sm">
                                            <p className="mb-2">{event.description}</p>
                                            <p className="text-xs text-gray-500">Coordenadas: {event.coordinates.lat}, {event.coordinates.lng}</p>
                                        </div>
                                    )}
                                </div>
                            ))}
                        </div>
                    </div>
                )}

                {/* Sound Map Tab */}
                {activeTab === 'map' && (
                    <div>
                        <h2 className="text-2xl font-mono uppercase tracking-wider mb-6 text-[#00e9fa]">{t('radio_nocaima_sound_map') || 'Mapa Sonoro Interactivo'}</h2>
                        <div className="grid md:grid-cols-3 gap-4">
                            <div className="md:col-span-2 border border-white/10 bg-white/5 rounded-sm p-6 min-h-96 flex items-center justify-center">
                                <div className="text-center">
                                    <MapPin className="text-[#00e9fa] mx-auto mb-4" size={48} />
                                    <p className="text-gray-400 text-sm">{t('radio_nocaima_map_interactive') || 'Mapa interactivo (requiere Leaflet)'}</p>
                                    <p className="text-gray-500 text-xs mt-2">{sound_map?.audio_points?.length} {t('radio_nocaima_audio_points') || 'puntos de audio'}</p>
                                </div>
                            </div>

                            <div className="space-y-2">
                                <p className="text-[#00e9fa] font-mono text-xs uppercase tracking-wider mb-3">{t('radio_nocaima_locations') || 'Ubicaciones'}</p>
                                {sound_map?.audio_points?.slice(0, 8).map((point, idx) => (
                                    <div key={idx} className="p-3 border border-white/10 bg-white/5 rounded cursor-pointer hover:border-[#00e9fa]/40 transition-colors">
                                        <p className="text-white text-sm font-mono">{point.name}</p>
                                        <p className="text-gray-400 text-xs">{point.description}</p>
                                    </div>
                                ))}
                            </div>
                        </div>
                    </div>
                )}

                {/* Support Tab */}
                {activeTab === 'support' && (
                    <div>
                        <h2 className="text-2xl font-mono uppercase tracking-wider mb-6 text-[#00e9fa]">{t('radio_nocaima_support_station') || 'Apoya la Estación'}</h2>
                        <div className="grid md:grid-cols-2 gap-6">
                            {support_page?.donation_options?.slice(0, 4).map((option, idx) => (
                                <div key={idx} className="border border-white/10 bg-white/5 rounded-sm p-6 hover:border-[#00e9fa]/60 transition-colors">
                                    <h3 className="text-white font-mono uppercase text-lg mb-2">{option.plan_name}</h3>
                                    <p className="text-2xl font-bold text-[#00e9fa] mb-4">{option.amount_display}</p>
                                    <p className="text-gray-300 text-sm mb-4">{option.description}</p>
                                    <ul className="space-y-2 mb-6 text-sm text-gray-400">
                                        {option.benefits?.slice(0, 3).map((benefit, bIdx) => (
                                            <li key={bIdx} className="flex items-start gap-2">
                                                <span className="text-[#00e9fa] mt-1">•</span>
                                                <span>{benefit}</span>
                                            </li>
                                        ))}
                                    </ul>
                                    <button className="w-full px-4 py-2 bg-[#00e9fa] text-black font-mono text-sm uppercase tracking-wider hover:bg-white transition-colors">
                                        {t('radio_nocaima_donate') || 'Contribuir'}
                                    </button>
                                </div>
                            ))}
                        </div>

                        <div className="mt-12 p-6 border border-[#00e9fa]/30 bg-[#00e9fa]/5 rounded-sm">
                            <div className="flex gap-3 items-start mb-3">
                                <AlertCircle className="text-[#00e9fa] flex-shrink-0 mt-1" size={20} />
                                <div>
                                    <p className="text-white font-mono text-sm uppercase tracking-wider mb-2">{t('radio_nocaima_transparency') || 'Transparencia'}</p>
                                    <p className="text-gray-300 text-sm">{support_page?.transparency_text}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                )}
            </div>

            {/* CTA Section */}
            <div className="py-16 px-8 max-w-6xl mx-auto border-t border-white/10">
                <div className="text-center">
                    <h2 className="text-3xl font-black uppercase italic mb-4 text-white">{t('radio_nocaima_join_community') || '¿Quieres participar?'}</h2>
                    <p className="text-gray-300 mb-8 max-w-2xl mx-auto">{t('radio_nocaima_correspondent_intro') || 'Envía tus historias, grabaciones y noticias de la comunidad'}</p>
                    <button className="px-8 py-3 bg-[#00e9fa] text-black font-mono text-sm uppercase tracking-wider hover:bg-white transition-colors">
                        {t('radio_nocaima_become_correspondent') || 'Ser Corresponsal'}
                    </button>
                </div>
            </div>

            {/* Demo Badge Notice */}
            <div className="py-8 px-8 bg-black/50 border-t border-white/10 text-center">
                <p className="text-gray-500 text-xs font-mono uppercase tracking-wider">
                    <span className="text-[#00e9fa]">[DEMO]</span> {t('radio_nocaima_demo_notice') || 'Este es un proyecto demo con contenido de demostración para fines ilustrativos'}
                </p>
            </div>
        </Layout>
    );
}
