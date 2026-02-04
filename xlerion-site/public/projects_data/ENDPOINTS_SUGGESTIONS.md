# Endpoints & API Integration Suggestions

## Estación Comunitaria Nocaima Demo

**Version:** 1.0  
**Date:** February 4, 2025  
**API Version:** REST/JSON  
**Authentication:** Token-based (optional for demo)

---

## Overview

This document outlines the suggested backend API structure to support the Radio Nocaima demo page. All endpoints should follow REST conventions and return JSON responses. The demo can operate in **offline mode** using hardcoded JSON data from `radio_nocaima_demo_content.json` or integrate with live endpoints.

---

## Base URL Structure

```
Production:  https://estacionnocaima.xlerion.local/api/
Staging:     https://staging-radio.xlerion.local/api/
Development: http://localhost:8080/api/
Demo Mode:   (No backend - uses bundled JSON)
```

---

## 1. PROJECT METADATA ENDPOINTS

### 1.1 GET /projects/{project_id}

**Description:** Retrieve project card metadata for display in the projects list.

**Request:**

```http
GET /api/projects/radio-nocaima-demo
Host: estacionnocaima.xlerion.local
Content-Type: application/json
```

**Response (200 OK):**

```json
{
  "id": "radio-nocaima-demo",
  "project_type": "community_radio",
  "status": "demo",
  "title": "Estación Comunitaria Nocaima",
  "short_description": "Plataforma de radio comunitaria con transmisión en vivo...",
  "thumbnail_url": "/images/projects/radio-nocaima-thumbnail.jpg",
  "tags": ["radio", "comunidad", "streaming", "demo"],
  "estimated_duration": "8 semanas",
  "difficulty": "Estándar",
  "demo_route": "/projects/radio-nocaima-demo",
  "featured": true,
  "seo": {
    "title": "Estación Comunitaria Nocaima - Radio en Vivo Comunitaria",
    "description": "Plataforma de radio comunitaria...",
    "og_image": "/images/projects/radio-nocaima-og.jpg"
  }
}
```

**Status Codes:**

- `200 OK` - Project found
- `404 Not Found` - Project does not exist
- `403 Forbidden` - Access denied

---

### 1.2 GET /projects/{project_id}/content

**Description:** Retrieve the complete demo page content (hero, player, episodes, calendar, etc.).

**Request:**

```http
GET /api/projects/radio-nocaima-demo/content?lang=es
Host: estacionnocaima.xlerion.local
Accept-Language: es-CO
```

**Query Parameters:**

- `lang` (optional): Language code (`es` or `en`, default: `es`)
- `include` (optional): Comma-separated sections to include (default: all)
  - Example: `include=hero,player,episodes` (limits response size)

**Response (200 OK):**

```json
{
  "project_id": "radio-nocaima-demo",
  "demo_route": "/projects/radio-nocaima-demo",
  "language": "es",
  "hero": { /* ... */ },
  "about_section": { /* ... */ },
  "live_player": { /* ... */ },
  "episodes_ondemand": { /* ... */ },
  "events_calendar": { /* ... */ },
  "correspondents_form": { /* ... */ },
  "sound_map": { /* ... */ },
  "support_page": { /* ... */ },
  "educational_section": { /* ... */ },
  "footer": { /* ... */ }
}
```

---

## 2. LIVE STREAMING ENDPOINTS

### 2.1 GET /streams/radio-nocaima/live

**Description:** Get live stream configuration (HLS manifest URL, bitrate options, current metadata).

**Request:**

```http
GET /api/streams/radio-nocaima/live
```

**Response (200 OK):**

```json
{
  "stream_id": "radio-nocaima-live",
  "status": "active",
  "stream_type": "hls",
  "primary_url": "https://demo-streams.xlerion.local/radio-nocaima/live.m3u8",
  "fallback_url": "https://demo-streams.xlerion.local/radio-nocaima/live.mp3",
  "bitrates": [
    { "bitrate": "128kbps", "format": "aac", "codec": "aac" },
    { "bitrate": "256kbps", "format": "aac", "codec": "aac" }
  ],
  "current_program": {
    "title": "Mañanitas Nocaima",
    "host": "María González",
    "start_time": "06:00",
    "end_time": "09:00",
    "description": "Programa matutino..."
  },
  "listener_count": 127,
  "peak_today": 342,
  "average_daily": 245,
  "started_at": "2025-02-04T06:00:00Z"
}
```

---

### 2.2 GET /streams/radio-nocaima/program-schedule

**Description:** Get today's or a specific day's program schedule.

**Request:**

```http
GET /api/streams/radio-nocaima/program-schedule?date=2025-02-04
```

**Query Parameters:**

- `date` (optional): ISO date format (`YYYY-MM-DD`, default: today)

**Response (200 OK):**

```json
{
  "date": "2025-02-04",
  "programs": [
    {
      "time": "06:00 - 09:00",
      "title": "Mañanitas Nocaima",
      "host": "María González",
      "type": "magazine",
      "description": "Programa matutino..."
    },
    {
      "time": "09:00 - 12:00",
      "title": "La Hora Agrícola",
      "host": "Roberto Campos",
      "type": "educational"
    }
    // ... more programs
  ]
}
```

---

## 3. EPISODES ENDPOINTS

### 3.1 GET /episodes

**Description:** List episodes with pagination, filtering, and search.

**Request:**

```http
GET /api/episodes?page=1&limit=12&category=magazine&search=nocaima
```

**Query Parameters:**

- `page` (optional): Page number, default 1
- `limit` (optional): Items per page, default 12, max 50
- `category` (optional): Filter by category (magazine, music, educational, community, entertainment, news)
- `search` (optional): Full-text search in title and description
- `sort` (optional): Sort by (newest, oldest, most_popular, longest), default newest
- `host_id` (optional): Filter by host

**Response (200 OK):**

```json
{
  "episodes": [
    {
      "id": "ep-001",
      "title": "Mañanitas Nocaima - Especial Café",
      "description": "Hablamos sobre la importancia del café...",
      "date": "2025-02-03",
      "duration": "180",
      "host": "María González",
      "category": "magazine",
      "thumbnail": "/images/episodes/ep-001-thumb.jpg",
      "audio_url": "https://demo-assets.xlerion.local/episodes/ep-001.mp3",
      "play_count": 145,
      "tags": ["café", "tradición", "productores"]
    }
    // ... more episodes
  ],
  "pagination": {
    "page": 1,
    "limit": 12,
    "total": 156,
    "pages": 13
  }
}
```

---

### 3.2 GET /episodes/{episode_id}

**Description:** Get detailed information about a specific episode.

**Request:**

```http
GET /api/episodes/ep-001
```

**Response (200 OK):**

```json
{
  "id": "ep-001",
  "title": "Mañanitas Nocaima - Especial Café",
  "full_description": "Hablamos sobre la importancia del café en nuestra región con productores locales. Incluye música típica y participación de oyentes.",
  "date": "2025-02-03",
  "duration": "180",
  "host": "María González",
  "category": "magazine",
  "thumbnail": "/images/episodes/ep-001-thumb.jpg",
  "audio_url": "https://demo-assets.xlerion.local/episodes/ep-001.mp3",
  "play_count": 145,
  "tags": ["café", "tradición", "productores"],
  "transcript": "...",  // Optional
  "show_notes": "...",  // Optional
  "related_episodes": [ /* episode IDs */ ]
}
```

---

## 4. EVENTS CALENDAR ENDPOINTS

### 4.1 GET /events

**Description:** List events with date filtering.

**Request:**

```http
GET /api/events?month=2025-02&sort=date_asc
```

**Query Parameters:**

- `month` (optional): ISO month format (`YYYY-MM`, default: current)
- `date_start` (optional): ISO date start range
- `date_end` (optional): ISO date end range
- `category` (optional): Filter by event type (festival, workshop, cultural, community, etc.)
- `sort` (optional): Sort by (date_asc, date_desc, featured), default date_asc

**Response (200 OK):**

```json
{
  "month": "2025-02",
  "events": [
    {
      "id": "event-001",
      "title": "Festival de Música Comunitaria",
      "description": "Gran festival con bandas locales...",
      "date": "2025-02-15",
      "time_start": "14:00",
      "time_end": "22:00",
      "location": "Parque Central Nocaima",
      "location_lat": 5.2521,
      "location_lng": -73.9253,
      "category": "festival",
      "image": "/images/events/festival-2025.jpg",
      "attendees": 450,
      "live_stream": true,
      "is_featured": true
    }
    // ... more events
  ],
  "upcoming_count": 6
}
```

---

### 4.2 GET /events/{event_id}

**Description:** Get full event details.

**Request:**

```http
GET /api/events/event-001
```

**Response (200 OK):**

```json
{
  "id": "event-001",
  "title": "Festival de Música Comunitaria",
  "description": "Gran festival con bandas locales, DJ y artistas de la región...",
  "long_description": "...",
  "date": "2025-02-15",
  "time_start": "14:00",
  "time_end": "22:00",
  "location": "Parque Central Nocaima",
  "location_lat": 5.2521,
  "location_lng": -73.9253,
  "category": "festival",
  "image": "/images/events/festival-2025.jpg",
  "images": [ /* gallery */ ],
  "attendees": 450,
  "live_stream": true,
  "stream_url": "...",
  "ical_url": "https://estacionnocaima.xlerion.local/api/events/event-001/ical",
  "is_featured": true,
  "performers": [
    { "name": "Banda Local 1", "type": "band" },
    { "name": "DJ Carlos", "type": "dj" }
  ]
}
```

---

### 4.3 POST /events/{event_id}/add-to-calendar

**Description:** Generate calendar file (iCal) for adding event to personal calendar.

**Request:**

```http
POST /api/events/event-001/add-to-calendar
Content-Type: application/json

{
  "calendar_type": "google",  // or "outlook", "ical"
  "email": "user@example.com"  // optional, for invitations
}
```

**Response (200 OK):**

```json
{
  "status": "success",
  "calendar_url": "https://calendar.google.com/calendar/u/0/r/eventedit?...",
  "ical_file": "https://estacionnocaima.xlerion.local/api/events/event-001/event.ics"
}
```

---

## 5. CORRESPONDENTS SUBMISSION ENDPOINTS

### 5.1 POST /correspondents/submit

**Description:** Submit correspondent content (audio, text, or link).

**Request:**

```http
POST /api/correspondents/submit
Content-Type: multipart/form-data
Authorization: Bearer {optional_token}

{
  "nombre": "Juan García",
  "email": "juan@email.com",
  "telefono": "+57 3001234567",
  "ubicacion": "Barrio Central",
  "categoria": "noticia",
  "titulo": "Construcción del nuevo acueducto",
  "descripcion": "Se inician los trabajos del proyecto...",
  "archivo_opcion": "archivo",
  "archivo_audio": [binary_data],
  "consentimiento": true,
  "privacidad": true
}
```

**Response (201 Created):**

```json
{
  "id": "correspondent-2025-0123",
  "status": "pending_review",
  "submitted_at": "2025-02-04T14:32:10Z",
  "submission_id": "sub-12345",
  "message": "¡Gracias! Tu contenido ha sido recibido. Nos pondremos en contacto en 2-3 días.",
  "next_steps": [
    "Nuestro equipo revisará tu contenido",
    "Te contactaremos para confirmar publicación",
    "Tu contenido se transmitirá en vivo"
  ],
  "tracking_url": "https://estacionnocaima.xlerion.local/submissions/correspondent-2025-0123"
}
```

**Error Response (400 Bad Request):**

```json
{
  "error": "validation_error",
  "fields": {
    "email": "Correo electrónico inválido",
    "archivo_audio": "El archivo debe ser MP3 o WAV (máx 50MB)"
  }
}
```

**Error Response (413 Payload Too Large):**

```json
{
  "error": "file_too_large",
  "message": "El archivo no debe superar 50MB",
  "max_size_mb": 50
}
```

---

### 5.2 GET /correspondents/{submission_id}

**Description:** Track status of a correspondent submission.

**Request:**

```http
GET /api/correspondents/correspondent-2025-0123
```

**Response (200 OK):**

```json
{
  "id": "correspondent-2025-0123",
  "status": "approved",
  "submitted_at": "2025-02-04T14:32:10Z",
  "approved_at": "2025-02-05T10:15:22Z",
  "title": "Construcción del nuevo acueducto",
  "published": true,
  "episode_url": "https://estacionnocaima.xlerion.local/episodes/ep-154",
  "broadcast_date": "2025-02-07",
  "broadcast_time": "09:00"
}
```

---

## 6. DONATIONS ENDPOINTS

### 6.1 POST /donations/initiate

**Description:** Initiate a donation or subscription.

**Request:**

```http
POST /api/donations/initiate
Content-Type: application/json

{
  "donation_type": "subscription",  // or "one_time"
  "plan_id": "monthly-member",
  "amount": 30000,
  "currency": "COP",
  "payment_method": "stripe",
  "email": "donor@example.com",
  "name": "Donor Name",
  "recurring": true
}
```

**Response (200 OK - Session Created):**

```json
{
  "donation_id": "don-2025-456",
  "status": "pending_payment",
  "session_id": "stripe-session-xyz",
  "payment_url": "https://checkout.stripe.com/pay/cs_...",
  "amount": 30000,
  "currency": "COP",
  "redirect_success": "https://estacionnocaima.xlerion.local/thank-you",
  "redirect_cancel": "https://estacionnocaima.xlerion.local/donations"
}
```

---

### 6.2 POST /donations/webhook (Stripe)

**Description:** Webhook handler for Stripe payment events.

**Request:**

```http
POST /api/donations/webhook
Content-Type: application/json
Stripe-Signature: t={timestamp},v1={signature}

{
  "id": "evt_123",
  "type": "payment_intent.succeeded",
  "data": {
    "object": {
      "id": "pi_123",
      "amount": 30000,
      "status": "succeeded",
      "metadata": {
        "donation_id": "don-2025-456"
      }
    }
  }
}
```

**Response (200 OK):**

```json
{
  "status": "processed",
  "donation_id": "don-2025-456"
}
```

---

### 6.3 GET /donations/{donation_id}/receipt

**Description:** Generate and send donation receipt.

**Request:**

```http
GET /api/donations/don-2025-456/receipt?format=pdf
```

**Response (200 OK):**

```
Content-Type: application/pdf
Content-Disposition: attachment; filename="receipt-don-2025-456.pdf"

[PDF Binary Data]
```

---

## 7. SOUND MAP ENDPOINTS

### 7.1 GET /soundmap/points

**Description:** Get all audio points on the sound map.

**Request:**

```http
GET /api/soundmap/points?format=geojson
```

**Query Parameters:**

- `format` (optional): `json` or `geojson`, default `json`

**Response (200 OK - GeoJSON Format):**

```json
{
  "type": "FeatureCollection",
  "features": [
    {
      "type": "Feature",
      "geometry": {
        "type": "Point",
        "coordinates": [-73.9253, 5.2521]
      },
      "properties": {
        "id": "point-001",
        "title": "Parque Central",
        "description": "Histórico punto de encuentro comunitario desde 1985",
        "audio_url": "https://demo-assets.xlerion.local/soundmap/parque-central.mp3",
        "duration": "2:34",
        "category": "cultural",
        "narrator": "Don Julio García"
      }
    }
    // ... more points
  ]
}
```

---

### 7.2 GET /soundmap/points/{point_id}

**Description:** Get detailed information about a specific sound map point.

**Request:**

```http
GET /api/soundmap/points/point-001
```

**Response (200 OK):**

```json
{
  "id": "point-001",
  "lat": 5.2521,
  "lng": -73.9253,
  "title": "Parque Central",
  "description": "Histórico punto de encuentro comunitario...",
  "audio_url": "https://demo-assets.xlerion.local/soundmap/parque-central.mp3",
  "thumbnail": "/images/soundmap/parque-central.jpg",
  "duration": "2:34",
  "category": "cultural",
  "narrator": "Don Julio García",
  "transcript": "...",
  "photo_gallery": [ /* URLs */ ],
  "related_events": [ /* event IDs */ ]
}
```

---

## 8. ANALYTICS ENDPOINTS

### 8.1 POST /analytics/event

**Description:** Track user interactions and events.

**Request:**

```http
POST /api/analytics/event
Content-Type: application/json

{
  "event_type": "play_live",
  "project_id": "radio-nocaima-demo",
  "user_session": "sess-xyz-123",
  "timestamp": "2025-02-04T14:32:10Z",
  "metadata": {
    "player_type": "hls",
    "device": "desktop",
    "browser": "Chrome/120.0",
    "duration_watched": 120
  }
}
```

**Supported Event Types:**

- `play_live` - User started listening to live stream
- `play_episode` - User played an episode
- `stop_stream` - User stopped listening
- `donate_click` - User clicked donate button
- `donate_complete` - Donation completed
- `submit_correspondent` - Form submitted
- `event_add_calendar` - User added event to calendar
- `soundmap_click` - User clicked sound map point
- `enrollment_click` - User clicked workshop enrollment

**Response (204 No Content or 202 Accepted):**

```
Status: 202 Accepted
```

---

### 8.2 GET /analytics/dashboard

**Description:** Get project analytics dashboard data.

**Request:**

```http
GET /api/analytics/dashboard?date_start=2025-02-01&date_end=2025-02-04
Authorization: Bearer {admin_token}
```

**Response (200 OK):**

```json
{
  "date_range": {
    "start": "2025-02-01",
    "end": "2025-02-04"
  },
  "metrics": {
    "total_listeners": 4523,
    "average_session_length": 1845,
    "peak_listeners": 342,
    "episodes_played": 892,
    "total_donations": 2450000,
    "correspondents_submitted": 12,
    "events_attended": 340
  },
  "events_breakdown": {
    "play_live": 1200,
    "play_episode": 892,
    "donate_click": 45,
    "donate_complete": 23,
    "submit_correspondent": 12
  },
  "top_episodes": [
    { "id": "ep-001", "plays": 145 },
    { "id": "ep-002", "plays": 89 }
  ]
}
```

---

## 9. ADMIN ENDPOINTS (With Authentication)

### 9.1 PUT /admin/projects/{project_id}

**Description:** Update project card or content (admin only).

**Request:**

```http
PUT /api/admin/projects/radio-nocaima-demo
Content-Type: application/json
Authorization: Bearer {admin_token}

{
  "title": "Estación Comunitaria Nocaima - Updated",
  "short_description": "Updated description...",
  "featured": true,
  "active": true
}
```

**Response (200 OK):**

```json
{
  "id": "radio-nocaima-demo",
  "updated_at": "2025-02-04T15:30:00Z",
  "changes": {
    "title": "Estación Comunitaria Nocaima - Updated",
    "short_description": "Updated description..."
  }
}
```

---

### 9.2 POST /admin/episodes

**Description:** Create or update an episode (admin only).

**Request:**

```http
POST /api/admin/episodes
Content-Type: multipart/form-data
Authorization: Bearer {admin_token}

{
  "title": "Nuevo Episodio",
  "description": "Descripción...",
  "date": "2025-02-05",
  "duration": 180,
  "host_id": "host-maria",
  "category": "magazine",
  "audio_file": [binary_audio_data],
  "thumbnail": [binary_image_data],
  "tags": ["tag1", "tag2"]
}
```

**Response (201 Created):**

```json
{
  "id": "ep-new-123",
  "title": "Nuevo Episodio",
  "status": "published",
  "created_at": "2025-02-04T15:35:00Z"
}
```

---

### 9.3 DELETE /admin/episodes/{episode_id}

**Description:** Delete an episode (admin only).

**Request:**

```http
DELETE /api/admin/episodes/ep-001
Authorization: Bearer {admin_token}
```

**Response (204 No Content):**

```
Status: 204
```

---

## 10. RATE LIMITING

All endpoints implement rate limiting:

```
Default: 100 requests per 15 minutes per IP

Headers in Response:
- X-RateLimit-Limit: 100
- X-RateLimit-Remaining: 92
- X-RateLimit-Reset: 1612354200

If Exceeded (429 Too Many Requests):
{
  "error": "rate_limit_exceeded",
  "retry_after": 300
}
```

---

## 11. ERROR HANDLING

**Standard Error Response Format:**

```json
{
  "error": "error_code",
  "message": "Human-readable error message",
  "status": 400,
  "timestamp": "2025-02-04T14:32:10Z",
  "request_id": "req-xyz-123"  // For debugging
}
```

**Common Error Codes:**

- `validation_error` (400)
- `unauthorized` (401)
- `forbidden` (403)
- `not_found` (404)
- `conflict` (409)
- `rate_limit_exceeded` (429)
- `internal_error` (500)

---

## 12. DEMO MODE / OFFLINE FALLBACK

For demonstration purposes without a live backend:

1. **Bundled JSON:** Include `radio_nocaima_demo_content.json` in the deployment
2. **Service Worker:** Implement offline-first caching
3. **Mock API:** JavaScript fetch interceptor returning bundled data
4. **Data Expiry:** Show cache timestamp footer

**Implementation Example:**

```javascript
// In React component
const useProjectData = (projectId) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`/api/projects/${projectId}/content`)
      .catch(() => {
        // Fallback to bundled JSON
        return import('/projects_data/radio_nocaima_demo_content.json')
          .then(m => ({ json: () => Promise.resolve(m.default) }))
      })
      .then(res => res.json())
      .then(setData)
      .finally(() => setLoading(false))
  }, [projectId])

  return { data, loading }
}
```

---

## 13. SECURITY CONSIDERATIONS

### CORS Policy

```
Allowed Origins: https://xlerion.local, https://estacionnocaima.local
Allowed Methods: GET, POST, PUT, DELETE
Allowed Headers: Content-Type, Authorization
Credentials: true (for session-based auth)
```

### Input Validation

- File uploads: virus scanning, type verification
- Form inputs: XSS sanitization, SQL injection prevention
- Queries: rate limiting, parameter validation

### Authentication (for admin/donation endpoints)

- JWT tokens with 1-hour expiry
- Refresh tokens with 7-day expiry
- HTTPS only (secure cookies)

---

## 14. TESTING PAYLOADS

### Test correspondent submission

```bash
curl -X POST https://estacionnocaima.local/api/correspondents/submit \
  -H "Content-Type: application/json" \
  -d '{
    "nombre": "Test User",
    "email": "test@example.com",
    "categoria": "noticia",
    "titulo": "Test Submission",
    "descripcion": "This is a test",
    "archivo_opcion": "enlace",
    "enlace_url": "https://example.com/audio.mp3",
    "consentimiento": true,
    "privacidad": true
  }'
```

### Test analytics event

```bash
curl -X POST https://estacionnocaima.local/api/analytics/event \
  -H "Content-Type: application/json" \
  -d '{
    "event_type": "play_live",
    "project_id": "radio-nocaima-demo",
    "timestamp": "'$(date -u +%Y-%m-%dT%H:%M:%SZ)'"
  }'
```

---

**End of Endpoints & API Suggestions Document**
