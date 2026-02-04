# Acceptance Criteria & Testing Framework

## Estación Comunitaria Nocaima Demo Project

**Version:** 1.0  
**Date:** February 4, 2025  
**QA Lead:** TBD  
**Status:** Ready for Testing

---

## Overview

This document defines the acceptance criteria for the Radio Nocaima demo project. All criteria must be met before the project is marked as "production-ready." Testing should follow this framework using both manual and automated approaches.

---

## Section 1: Card Component (Landing Page)

### AC 1.1: Card Displays in Projects Section

**Given:** User navigates to Xlerion.com landing page  
**When:** Page loads and scrolls to "Proyectos" section  
**Then:**

- [ ] Radio Nocaima card appears in grid with other projects
- [ ] Card position is consistent across page reloads
- [ ] Card is visible without horizontal scrolling on desktop
- [ ] Mobile view stacks card properly (1 column)

**Test Data:** Production landing page (`/`)  
**Test Browsers:** Chrome, Firefox, Safari, Edge  
**Pass Criteria:** Card visible and properly positioned on all browsers

---

### AC 1.2: Card Visual Design Correct

**When:** Card displays on landing page  
**Then:**

- [ ] Background color matches brand: `#0a0a0a`
- [ ] Text color matches brand: white for title, gray for description
- [ ] Border style is 1px solid `rgba(255,255,255,0.1)`
- [ ] Card spacing and padding correct (consistent with other cards)
- [ ] Thumbnail image loads and displays correctly
- [ ] No text truncation or overflow
- [ ] Font sizes match spec (title 24px, description 14px)

**Test Artifacts:**

- Visual regression test (screenshot comparison)
- CSS inspection in DevTools
- Responsive design tester (BrowserStack)

**Pass Criteria:** Visual design matches spec on all viewports

---

### AC 1.3: Hover State Functions Correctly

**When:** User hovers over card on desktop  
**Then:**

- [ ] Border color changes to `#00e9fa` within 300ms
- [ ] Background color slightly brightens
- [ ] Card scales up to 1.02x
- [ ] Thumbnail brightness increases to 105%
- [ ] Transition is smooth (300ms ease)

**When:** User hovers on thumbnail specifically  
**Then:**

- [ ] Preview overlay appears after 200ms
- [ ] Overlay opacity: 0.7, color: black
- [ ] Text overlay displays:
  - "Estación Comunitaria Nocaima" (bold)
  - "La voz de nuestra comunidad" (regular)

**Test Method:** Manual hover testing + CSS inspection  
**Pass Criteria:** All hover states animate smoothly

---

### AC 1.4: Click/Tap Action Works

**Given:** User clicks card on desktop or taps on mobile  
**When:** Click/tap happens  
**Then:**

- [ ] New tab opens (target="_blank")
- [ ] URL is `/projects/radio-nocaima-demo`
- [ ] Page loads without errors
- [ ] No console errors logged
- [ ] Analytics event fired: `project_card_click` with `project_id: "radio-nocaima-demo"`

**When:** User clicks "Ver demo" button  
**Then:**

- [ ] Same behavior as card click (no double-opens)
- [ ] New tab opens to correct URL

**Test Method:** Manual click testing + analytics verification  
**Pass Criteria:** Link opens new tab with correct URL, analytics event fires

---

### AC 1.5: Tags Display Correctly

**When:** Card displays  
**Then:**

- [ ] Tags appear as inline badges below description
- [ ] Tags shown: `[radio]`, `[comunidad]`, `[streaming]`, `[demo]`
- [ ] Each tag has proper styling (background, padding, spacing)
- [ ] Tags don't wrap onto multiple lines (text-align)
- [ ] Tags fit within card width on all viewports

**Test Method:** Visual inspection, responsive testing  
**Pass Criteria:** All tags display inline without wrapping

---

### AC 1.6: Metadata Fields Display

**When:** Card displays  
**Then:**

- [ ] Difficulty displayed: "Estándar"
- [ ] Duration displayed: "8 semanas"
- [ ] Both fields use consistent formatting
- [ ] Fields clearly separated/labeled

**Test Method:** Visual inspection  
**Pass Criteria:** All metadata visible and properly formatted

---

### AC 1.7: Demo Badge Visible

**When:** Card displays  
**Then:**

- [ ] Small badge or label indicates this is a demo
- [ ] Badge clearly visible (e.g., "Demo" in top-right corner)
- [ ] Badge styling distinct from production cards

**Test Method:** Visual inspection  
**Pass Criteria:** Demo status clearly indicated on card

---

## Section 2: Demo Page - Loading & Navigation

### AC 2.1: Page Loads Successfully

**Given:** User clicks "Ver demo" on card  
**When:** Demo page loads (`/projects/radio-nocaima-demo`)  
**Then:**

- [ ] Page loads within 3 seconds (LCP)
- [ ] No console errors (JavaScript)
- [ ] No 404 errors for assets
- [ ] Page title updates to: "Estación Comunitaria Nocaima"
- [ ] Breadcrumbs display correctly

**Test Method:** Lighthouse audit, Network tab monitoring  
**Pass Criteria:** Page Lighthouse score ≥ 85, no errors

---

### AC 2.2: Hero Section Displays

**When:** Page loads  
**Then:**

- [ ] Hero image displays (1920x1080px recommended)
- [ ] Hero text overlays image (readable with sufficient contrast)
- [ ] Title: "Estación Comunitaria Nocaima" visible (64px, bold)
- [ ] Subtitle visible and readable
- [ ] CTA buttons present: "Escuchar en vivo" and "Explorar episodios"
- [ ] Parallax effect works on desktop (scrolling)
- [ ] Mobile: image still visible with no parallax

**Test Method:** Visual inspection, cross-browser testing  
**Pass Criteria:** Hero displays correctly with readable text on all devices

---

### AC 2.3: Accessibility - Demo Badge

**When:** Page loads  
**Then:**

- [ ] "Demo — contenido de ejemplo" badge visible
- [ ] Badge appears in prominent location (top-right or footer)
- [ ] Message is clear that this is demo content
- [ ] Badge doesn't obscure important content

**Test Method:** Visual inspection, screen reader test  
**Pass Criteria:** Demo mode clearly indicated

---

### AC 2.4: Navigation Works

**When:** User interacts with page  
**Then:**

- [ ] Clicking "Escuchar en vivo" scrolls to player section
- [ ] Clicking "Explorar episodios" scrolls to episodes section
- [ ] Scroll is smooth (animation 500ms)
- [ ] Navigation scrolls to correct section header

**Test Method:** Manual click and scroll testing  
**Pass Criteria:** All navigation links scroll to correct sections

---

## Section 3: Live Player

### AC 3.1: Player Initializes

**When:** Page loads or scrolls to player section  
**Then:**

- [ ] HTML5 audio player renders
- [ ] Player loads stream configuration
- [ ] Player displays "Cargando..." status initially
- [ ] Player fully loads within 5 seconds

**Test Method:** Monitor Network tab, visual inspection  
**Pass Criteria:** Player initializes and loads stream within 5s

---

### AC 3.2: Stream Playback Works (Desktop)

**When:** User clicks play button on player  
**Then:**

- [ ] HLS stream initiates (attempts `.m3u8` URL)
- [ ] Audio plays through browser speaker/headphones
- [ ] Play button changes to pause icon
- [ ] Current time display updates
- [ ] No console errors
- [ ] Player volume defaults to 80%

**Test Browsers:** Chrome, Firefox, Safari  
**Test Method:** Manual audio testing with headphones  
**Pass Criteria:** Audio plays on all desktop browsers

---

### AC 3.3: Fallback to MP3 (If HLS Fails)

**When:** HLS stream unavailable or unsupported  
**Then:**

- [ ] Player automatically attempts MP3 fallback stream
- [ ] Audio plays through MP3 stream
- [ ] No error message displayed (seamless fallback)
- [ ] User hears no interruption

**Test Method:** Mock HLS failure in DevTools, verify MP3 fallback  
**Pass Criteria:** MP3 fallback works transparently

---

### AC 3.4: Mobile Stream Playback

**When:** User on iOS/Android accesses player  
**Then:**

- [ ] Stream plays on mobile browser
- [ ] Controls are touch-friendly (large buttons)
- [ ] Volume control works via device controls or player slider
- [ ] Audio plays through device speaker or headphones

**Test Devices:** iPhone (latest), Android (Pixel or equivalent)  
**Test Method:** Manual testing on real devices  
**Pass Criteria:** Audio plays on both iOS and Android

---

### AC 3.5: Player Controls Function

**When:** Player is active and audio playing  
**Then:**

- [ ] **Play/Pause button** toggles audio playback
- [ ] **Volume slider** adjusts volume 0-100%
- [ ] **Mute button** (if present) mutes/unmutes audio
- [ ] **Quality selector** (if applicable) allows bitrate selection
- [ ] **Share button** provides social share options
- [ ] **Fullscreen** (if applicable) enters fullscreen mode

**Test Method:** Manual click testing, visual inspection  
**Pass Criteria:** All controls respond to user input

---

### AC 3.6: Keyboard Accessibility (Player)

**When:** User navigates with keyboard  
**Then:**

- [ ] Tab key focuses play button
- [ ] Space key plays/pauses
- [ ] Arrow keys (← →) seek forward/backward
- [ ] Arrow keys (↑ ↓) adjust volume
- [ ] Focus indicator visible (2px solid cyan outline)

**Test Method:** Keyboard-only navigation testing  
**Pass Criteria:** All controls accessible via keyboard

---

### AC 3.7: Program Information Displays

**When:** Player is active  
**Then:**

- [ ] Current program title displays: "Mañanitas Nocaima"
- [ ] Host name displays: "María González"
- [ ] Program time displays: "06:00 - 09:00"
- [ ] Program description visible (truncated, with expand option)
- [ ] Updated when program changes

**Test Method:** Visual inspection  
**Pass Criteria:** Program info displays accurately

---

### AC 3.8: Listener Statistics Display

**When:** Player is active  
**Then:**

- [ ] Current listeners count shows (e.g., "127")
- [ ] Peak today shows (e.g., "342")
- [ ] Average daily shows (e.g., "245")
- [ ] Stats update in real-time (or at least every 10 seconds)

**Test Method:** Visual inspection, monitor Network requests  
**Pass Criteria:** Stats display and update regularly

---

### AC 3.9: Error Handling (Player)

**When:** Stream is unavailable  
**Then:**

- [ ] Player shows friendly error message
- [ ] Error message: "Stream no disponible en este momento"
- [ ] Retry button provided
- [ ] No console errors
- [ ] Contact info provided (WhatsApp, email)

**Test Method:** Mock stream failure, visual inspection  
**Pass Criteria:** Error message displays clearly

---

## Section 4: Episodes On-Demand

### AC 4.1: Episodes Load

**When:** User scrolls to episodes section  
**Then:**

- [ ] Episodes list displays with at least 3 demo episodes
- [ ] Each episode shows thumbnail, title, host, duration
- [ ] Episodes load within 2 seconds
- [ ] No console errors

**Test Method:** Visual inspection, Network monitoring  
**Pass Criteria:** Episodes display within 2 seconds

---

### AC 4.2: Episode Playback

**When:** User clicks play button on episode  
**Then:**

- [ ] Audio player modal/inline player opens
- [ ] Episode audio plays
- [ ] Play duration matches spec (e.g., "3:00")
- [ ] Can pause and resume
- [ ] Progress bar updates during playback

**Test Method:** Manual audio testing  
**Pass Criteria:** Episode audio plays correctly

---

### AC 4.3: Search & Filter Work

**When:** User types in search box  
**Then:**

- [ ] Search filters episodes by title/description in real-time
- [ ] Results update as user types
- [ ] Matching episodes highlight or update view

**When:** User selects category filter  
**Then:**

- [ ] Episodes filtered by category (magazine, music, educational, etc.)
- [ ] Only matching episodes display
- [ ] Filter can be cleared

**Test Method:** Manual testing with different search terms and filters  
**Pass Criteria:** Search and filters work correctly

---

### AC 4.4: Pagination Works

**When:** More than 12 episodes exist  
**Then:**

- [ ] Pagination controls display at bottom
- [ ] Can navigate: Previous, Next, and numbered pages
- [ ] Page numbers update URL (for bookmarking)
- [ ] New page loads within 1 second

**Test Method:** Manual pagination testing  
**Pass Criteria:** Pagination navigates correctly

---

### AC 4.5: Donation Button Present

**When:** Episode card displays  
**Then:**

- [ ] "Donar" button visible on each episode
- [ ] Button leads to donation flow
- [ ] Donation amount options available (5K, 10K, 25K, 50K COP)

**Test Method:** Visual inspection  
**Pass Criteria:** Donation CTA visible and clickable

---

## Section 5: Calendar Events

### AC 5.1: Calendar Displays

**When:** User scrolls to calendar section  
**Then:**

- [ ] Calendar shows current month (February 2025)
- [ ] All days of month visible
- [ ] Days with events marked with indicator (dot, color, etc.)
- [ ] Navigation buttons (< >) to change months
- [ ] "Hoy" button returns to current date

**Test Method:** Visual inspection  
**Pass Criteria:** Calendar displays correctly with event indicators

---

### AC 5.2: Event Details Show

**When:** User clicks on an event date/marker  
**Then:**

- [ ] Event details modal/panel appears
- [ ] Shows: title, date, time, location, description, image
- [ ] Expected attendees count displays
- [ ] Live stream indicator shown (if applicable)
- [ ] Multiple events on same date handled (list or carousel)

**Test Method:** Manual click testing on events  
**Pass Criteria:** Event details display when clicked

---

### AC 5.3: Add to Calendar Works

**When:** User clicks "Añadir a calendario" button  
**Then:**

- [ ] Dropdown or dialog appears with calendar options
  - [ ] Google Calendar
  - [ ] Outlook
  - [ ] Apple Calendar (iCal)
- [ ] Clicking option opens calendar app or generates .ics file
- [ ] Event details correctly imported to calendar

**Test Method:** Manual testing with different calendar apps  
**Pass Criteria:** Events can be added to multiple calendar types

---

### AC 5.4: Location Map Shows

**When:** Event details display  
**Then:**

- [ ] Event location address displayed
- [ ] Map pin shows location coordinates
- [ ] User can click to expand map or open in Google Maps

**Test Method:** Visual inspection, map click testing  
**Pass Criteria:** Location clearly shown on map

---

## Section 6: Correspondent Form

### AC 6.1: Form Displays & Fields Correct

**When:** User scrolls to correspondent section  
**Then:**

- [ ] Intro text displays: "¿Tienes una historia que contar?"
- [ ] All form fields visible:
  - [ ] Nombre (required)
  - [ ] Email (required)
  - [ ] Teléfono (optional)
  - [ ] Ubicación (optional)
  - [ ] Categoría (required dropdown)
  - [ ] Título (required)
  - [ ] Descripción (required textarea)
  - [ ] Archivo opción (radio: upload/whatsapp/link)
  - [ ] Consentimiento (required checkbox)
  - [ ] Privacidad (required checkbox)
- [ ] Labels clearly associated with inputs
- [ ] Form is mobile-responsive

**Test Method:** Visual inspection, form auditing  
**Pass Criteria:** All form fields present and accessible

---

### AC 6.2: Form Validation Works

**When:** User leaves required field empty and tries to submit  
**Then:**

- [ ] Field highlights with red border
- [ ] Error message displays: "Este campo es obligatorio"
- [ ] Submit button disabled until field filled
- [ ] Focus moves to first error field

**When:** User enters invalid email  
**Then:**

- [ ] Email field shows error: "Correo electrónico inválido"
- [ ] Cannot submit form

**Test Method:** Manual form testing with invalid inputs  
**Pass Criteria:** All validations work correctly

---

### AC 6.3: Conditional Fields Work

**When:** User selects "Subir archivo" option  
**Then:**

- [ ] File upload input appears
- [ ] Accepts audio files: MP3, WAV, FLAC
- [ ] Shows file size limit: 50MB
- [ ] Other options hidden (WhatsApp, link)

**When:** User selects "Enviar por WhatsApp"  
**Then:**

- [ ] WhatsApp link button appears
- [ ] Other fields hidden

**When:** User selects "Compartir enlace"  
**Then:**

- [ ] URL input field appears
- [ ] File upload hidden

**Test Method:** Manual interaction testing  
**Pass Criteria:** Conditional fields show/hide correctly

---

### AC 6.4: Form Submission Works

**When:** User fills all required fields correctly and clicks submit  
**Then:**

- [ ] Loading indicator shows ("Enviando...")
- [ ] Form disables during submission
- [ ] Request sent to `/api/correspondents/submit`
- [ ] Response received within 5 seconds
- [ ] Success message displays:
  - [ ] "¡Gracias por tu contribución!"
  - [ ] "Te contactaremos en 2-3 días"
  - [ ] Submission ID/tracking link provided

**Test Method:** Manual form submission, Network monitoring  
**Pass Criteria:** Form submits successfully and shows success message

---

### AC 6.5: Error Handling (Form)

**When:** Form submission fails (server error, network issue)  
**Then:**

- [ ] Error message displays
- [ ] Form remains filled (doesn't clear)
- [ ] Retry option available
- [ ] Support contact info provided

**Test Method:** Mock server error, test network failure  
**Pass Criteria:** Errors handled gracefully

---

### AC 6.6: WhatsApp Alternative

**When:** User clicks "Enviar por WhatsApp" button  
**Then:**

- [ ] WhatsApp link opens (clicks open chat)
- [ ] Message pre-fills with correspondent info request
- [ ] Link works on desktop and mobile

**Test Method:** Manual WhatsApp link testing on mobile/desktop  
**Pass Criteria:** WhatsApp link opens chat application

---

## Section 7: Sound Map

### AC 7.1: Map Initializes

**When:** User scrolls to sound map section  
**Then:**

- [ ] Leaflet map loads and renders
- [ ] Map centered on Nocaima coordinates (5.2521, -73.9253)
- [ ] Zoom level 14 set
- [ ] Tiles load from OpenStreetMap

**Test Method:** Visual inspection, Network monitoring  
**Pass Criteria:** Map loads within 2 seconds

---

### AC 7.2: Audio Points Display

**When:** Map loads  
**Then:**

- [ ] 8 markers/pins display on map
- [ ] All points have visible icons/markers
- [ ] Markers clickable
- [ ] No markers overlapping (or cluster if needed)

**Test Method:** Visual inspection, marker counting  
**Pass Criteria:** All 8 points visible and distinct

---

### AC 7.3: Point Details & Audio Playback

**When:** User clicks a marker  
**Then:**

- [ ] Popup appears with point details
- [ ] Shows: title, description, narrator, category
- [ ] Audio player appears in popup
- [ ] Clicking play button plays audio
- [ ] Audio duration displays correctly

**Test Method:** Manual click and audio testing  
**Pass Criteria:** Audio plays from map point

---

### AC 7.4: Map Interaction (Desktop)

**When:** User interacts with map on desktop  
**Then:**

- [ ] Zoom in/out with mouse wheel
- [ ] Pan by click-drag
- [ ] Zoom controls (+/-) functional
- [ ] Map doesn't interfere with page scroll (scroll wheel zooms map)

**Test Method:** Manual map interaction testing  
**Pass Criteria:** All map controls work

---

### AC 7.5: Map Interaction (Mobile)

**When:** User interacts with map on mobile  
**Then:**

- [ ] Pinch-zoom works
- [ ] Two-finger pan works
- [ ] Zoom controls (+/-) present and functional
- [ ] Map doesn't prevent page scroll

**Test Method:** Manual testing on mobile device  
**Pass Criteria:** Map is touch-friendly and usable

---

### AC 7.6: Map Responsive

**When:** Page viewed on different screen sizes  
**Then:**

- [ ] Desktop (1024px+): map full width
- [ ] Tablet (768px): map 100% width with proper aspect ratio
- [ ] Mobile (< 768px): map 100% width, height adjusted
- [ ] No horizontal scroll on any device

**Test Method:** Responsive testing (DevTools, BrowserStack)  
**Pass Criteria:** Map responsive on all breakpoints

---

## Section 8: Support/Donation

### AC 8.1: Donation Options Display

**When:** User scrolls to support section  
**Then:**

- [ ] At least 4 donation option cards display
- [ ] Cards show: title, amount, benefits
- [ ] Each card has "Seleccionar" or "Donar" button
- [ ] Pricing in COP displayed correctly

**Test Method:** Visual inspection  
**Pass Criteria:** All donation options visible and formatted correctly

---

### AC 8.2: Donation Initiation (Stripe)

**When:** User selects donation option and clicks button  
**Then:**

- [ ] Stripe checkout initiates
- [ ] Checkout page/modal opens
- [ ] Amount pre-filled correctly
- [ ] User can complete payment via credit card

**Test Method:** Manual Stripe payment testing (use test card)  
**Pass Criteria:** Stripe checkout works correctly

---

### AC 8.3: Transparency Budget Chart Displays

**When:** Support section displays  
**Then:**

- [ ] Budget breakdown chart shows
- [ ] Categories: Infrastructure (35%), Production (30%), Equipment (20%), Development (15%)
- [ ] Percentages total 100%
- [ ] Chart is visual (pie/bar chart)

**Test Method:** Visual inspection  
**Pass Criteria:** Budget transparency displayed clearly

---

## Section 9: Education Section

### AC 9.1: Workshops Display

**When:** User scrolls to education section  
**Then:**

- [ ] At least 3 workshop cards display
- [ ] Each card shows: title, duration, instructor, schedule, price
- [ ] Cards have "Inscribirse" button
- [ ] Cards are responsive

**Test Method:** Visual inspection  
**Pass Criteria:** Workshop cards display correctly

---

### AC 9.2: Workshop CTA Works

**When:** User clicks "Inscribirse" button  
**Then:**

- [ ] Enrollment form or external link opens
- [ ] Form includes: name, email, workshop selection
- [ ] Payment/registration process initiated

**Test Method:** Manual CTA testing  
**Pass Criteria:** Enrollment button redirects correctly

---

## Section 10: Footer

### AC 10.1: Footer Information Complete

**When:** Page scrolls to footer  
**Then:**

- [ ] Company name displays: "Estación Comunitaria Nocaima"
- [ ] Tagline displays: "La voz de nuestra comunidad"
- [ ] Contact info visible:
  - [ ] Email: <contacto@estacionnocaima.local>
  - [ ] WhatsApp: +57 3001234567
  - [ ] Phone: +57 1 8765432
- [ ] Social media links present (Facebook, Instagram, WhatsApp, YouTube)

**Test Method:** Visual inspection  
**Pass Criteria:** All footer info present and correct

---

### AC 10.2: Footer Links Work

**When:** User clicks footer links  
**Then:**

- [ ] Social media links open correct profiles in new tabs
- [ ] Email link opens mailto: handler
- [ ] WhatsApp link opens WhatsApp chat
- [ ] All links functional

**Test Method:** Manual link testing  
**Pass Criteria:** All footer links work correctly

---

### AC 10.3: Metrics Display

**When:** Footer displays  
**Then:**

- [ ] Total downloads: 12,450
- [ ] Active listeners: 127
- [ ] Episodes published: 156
- [ ] Years on air: 3
- [ ] All metrics visible and formatted

**Test Method:** Visual inspection  
**Pass Criteria:** Metrics display correctly

---

## Section 11: Accessibility

### AC 11.1: Keyboard Navigation

**Given:** User with keyboard only  
**When:** Tab through entire page  
**Then:**

- [ ] Tab order is logical (top to bottom, left to right)
- [ ] All interactive elements reachable (buttons, links, form fields)
- [ ] No keyboard traps (not stuck on element)
- [ ] Focus indicators visible everywhere (2px cyan outline)
- [ ] Enter key works to activate buttons
- [ ] Escape key closes modals

**Test Method:** Keyboard-only navigation audit  
**Pass Criteria:** All elements accessible via keyboard, logical tab order

---

### AC 11.2: Screen Reader Testing

**Using:** NVDA (Windows), VoiceOver (Mac), or TalkBack (Android)  
**When:** Screen reader navigates page  
**Then:**

- [ ] Page title announced
- [ ] Headings announced with level (h1, h2, etc.)
- [ ] Form labels associated and announced with inputs
- [ ] Buttons have descriptive labels
- [ ] Image alt text descriptive (not "image" or "photo")
- [ ] Links have descriptive text (not "click here")
- [ ] List structure announced
- [ ] Navigation landmarks announced (nav, main, aside)
- [ ] Dynamic content updates announced

**Test Method:** Screen reader testing with NVDA and VoiceOver  
**Pass Criteria:** All content accessible to screen readers

---

### AC 11.3: Color Contrast

**Test:** Use Axe DevTools or Wave plugin  
**When:** Testing page colors  
**Then:**

- [ ] Text vs background ≥ 4.5:1 contrast ratio (WCAG AA)
- [ ] Large text (18px+) ≥ 3:1 contrast ratio
- [ ] Color not sole means of conveying information
- [ ] Error messages have text in addition to color

**Test Method:** Automated color contrast checking  
**Pass Criteria:** All text meets WCAG AA contrast ratios

---

### AC 11.4: Responsive Text

**When:** User increases text size (browser zoom)  
**Then:**

- [ ] Text remains readable at 200% zoom
- [ ] No horizontal scroll at 200% zoom on mobile
- [ ] Layout adapts (doesn't break)

**Test Method:** Browser zoom testing  
**Pass Criteria:** Page readable at 200% zoom

---

## Section 12: Performance

### AC 12.1: Page Load Time

**When:** Page loads on desktop (regular 4G, no cache)  
**Then:**

- [ ] First Contentful Paint (FCP) < 2.5 seconds
- [ ] Largest Contentful Paint (LCP) < 4 seconds
- [ ] Cumulative Layout Shift (CLS) < 0.1
- [ ] Lighthouse Performance score ≥ 85

**Test Method:** Lighthouse audit, WebPageTest  
**Pass Criteria:** Metrics meet targets

---

### AC 12.2: Mobile Performance

**When:** Page loads on 4G throttling  
**Then:**

- [ ] Page usable within 5 seconds
- [ ] LCP < 6 seconds
- [ ] No significant layout shifts

**Test Method:** Chrome DevTools throttling, Lighthouse mobile  
**Pass Criteria:** Mobile metrics acceptable

---

### AC 12.3: Asset Optimization

**When:** Inspecting Network tab  
**Then:**

- [ ] HTML < 200KB
- [ ] CSS < 150KB
- [ ] JavaScript < 300KB
- [ ] Total assets < 5MB (excluding videos)
- [ ] Images compressed (WEBP with JPG fallback)
- [ ] No unused CSS or JavaScript

**Test Method:** Network tab inspection, audit tools  
**Pass Criteria:** Assets within size limits

---

### AC 12.4: Lazy Loading

**When:** Page loads initially  
**Then:**

- [ ] Offscreen images not loaded initially
- [ ] Offscreen sections not loaded initially
- [ ] Images lazy-load when scrolled into view
- [ ] No performance degradation

**Test Method:** Network tab monitoring, scroll testing  
**Pass Criteria:** Lazy loading implemented

---

## Section 13: SEO & Analytics

### AC 13.1: Meta Tags Present

**When:** Page loads  
**Then:**

- [ ] Page title: "Estación Comunitaria Nocaima - Radio en Vivo Comunitaria"
- [ ] Meta description: "Plataforma de radio comunitaria con transmisión en vivo..."
- [ ] OG:image URL valid and image loads
- [ ] OG:title and OG:description set
- [ ] Canonical URL set

**Test Method:** View page source, Open Graph debugger  
**Pass Criteria:** All meta tags present and correct

---

### AC 13.2: Structured Data Markup

**When:** Checking page source  
**Then:**

- [ ] Schema.org markup for event present (JSON-LD)
- [ ] Schema.org markup for media/creative work present
- [ ] No structured data errors (Google Rich Results Test)

**Test Method:** Google Rich Results Test, Schema.org validator  
**Pass Criteria:** Structured data valid

---

### AC 13.3: Analytics Events Fired

**When:** User interacts with page elements  
**Then:**

- [ ] Event: `project_card_click` fires when card clicked
- [ ] Event: `play_live` fires when play clicked
- [ ] Event: `play_episode` fires when episode played
- [ ] Event: `donate_click` fires when donate button clicked
- [ ] Event: `submit_correspondent` fires when form submitted
- [ ] Event: `event_add_calendar` fires when event added to calendar
- [ ] All events include correct payload (project_id, user_session, timestamp, metadata)

**Test Method:** Monitor Analytics dashboard, Network tab  
**Pass Criteria:** All events fire with correct data

---

## Section 14: Browser & Device Compatibility

### AC 14.1: Desktop Browsers

**Test All:**

- [ ] Chrome 120+ (latest)
- [ ] Firefox 121+ (latest)
- [ ] Safari 17+ (latest on Mac)
- [ ] Edge 121+ (latest)

**For Each Browser:**

- [ ] Page loads without errors
- [ ] All player features work
- [ ] Forms submit correctly
- [ ] Maps render
- [ ] Animations smooth

**Test Method:** Cross-browser testing (BrowserStack or manual)  
**Pass Criteria:** All browsers render and function correctly

---

### AC 14.2: Mobile Browsers

**Test All:**

- [ ] iOS Safari (latest iPhone)
- [ ] Android Chrome (latest Android)
- [ ] iOS Chrome (if available)
- [ ] Samsung Internet (if testable)

**For Each:**

- [ ] Page responsive
- [ ] Touch controls work
- [ ] Forms usable on small screens
- [ ] Player plays audio
- [ ] No horizontal scroll

**Test Method:** Real device testing or emulation  
**Pass Criteria:** Mobile browsers fully functional

---

### AC 14.3: Device Breakpoints

**Test Viewport Sizes:**

- [ ] 320px (mobile small)
- [ ] 375px (iPhone SE/8)
- [ ] 425px (iPhone 12/13)
- [ ] 768px (iPad/tablet)
- [ ] 1024px (desktop small)
- [ ] 1440px (desktop medium)
- [ ] 1920px (desktop large)

**For Each Breakpoint:**

- [ ] Layout adapts correctly
- [ ] No text truncation
- [ ] Images scale appropriately
- [ ] Forms usable

**Test Method:** DevTools responsive mode testing  
**Pass Criteria:** Layout correct on all breakpoints

---

## Section 15: Security

### AC 15.1: HTTPS/SSL

**When:** Accessing page  
**Then:**

- [ ] Page served over HTTPS
- [ ] SSL certificate valid (no warnings)
- [ ] Mixed content warnings: none

**Test Method:** Browser address bar, SSL checker tools  
**Pass Criteria:** HTTPS enforced, no warnings

---

### AC 15.2: Form Submission Security

**When:** Submitting correspondent form  
**Then:**

- [ ] Form data sent over HTTPS
- [ ] CSRF token present and validated
- [ ] No sensitive data in URL (POST method used)
- [ ] File uploads validated server-side

**Test Method:** Network inspection, form testing  
**Pass Criteria:** Form submissions secure

---

### AC 15.3: Input Sanitization

**When:** Submitting form with special characters/HTML  
**Then:**

- [ ] HTML characters escaped (not rendered as HTML)
- [ ] No script injection possible
- [ ] No XSS vulnerabilities

**Test Method:** Pentest with XSS payloads  
**Pass Criteria:** All inputs sanitized

---

### AC 15.4: File Upload Validation

**When:** Uploading audio file to correspondent form  
**Then:**

- [ ] Only audio files accepted
- [ ] File size limit enforced (50MB max)
- [ ] File type validated (MIME type check)
- [ ] Uploaded files stored securely
- [ ] Files not accessible via direct URL

**Test Method:** File upload testing with various file types  
**Pass Criteria:** Only valid audio files accepted

---

## Test Execution Log

### Test Environment

- **Date Testing Starts:** __________
- **QA Tester:** __________
- **Testing Duration:** __________
- **Environment:** ☐ Local ☐ Staging ☐ Production

### Summary Results

| Section | Tests | Passed | Failed | Blocked | Status |
|---------|-------|--------|--------|---------|--------|
| Card Component | 7 | __ | __ | __ | ☐ Pass ☐ Fail |
| Page Loading | 4 | __ | __ | __ | ☐ Pass ☐ Fail |
| Live Player | 9 | __ | __ | __ | ☐ Pass ☐ Fail |
| Episodes | 5 | __ | __ | __ | ☐ Pass ☐ Fail |
| Calendar | 4 | __ | __ | __ | ☐ Pass ☐ Fail |
| Correspondent | 6 | __ | __ | __ | ☐ Pass ☐ Fail |
| Sound Map | 6 | __ | __ | __ | ☐ Pass ☐ Fail |
| Support | 3 | __ | __ | __ | ☐ Pass ☐ Fail |
| Education | 2 | __ | __ | __ | ☐ Pass ☐ Fail |
| Footer | 3 | __ | __ | __ | ☐ Pass ☐ Fail |
| Accessibility | 4 | __ | __ | __ | ☐ Pass ☐ Fail |
| Performance | 4 | __ | __ | __ | ☐ Pass ☐ Fail |
| SEO/Analytics | 3 | __ | __ | __ | ☐ Pass ☐ Fail |
| Browser Compat | 2 | __ | __ | __ | ☐ Pass ☐ Fail |
| Security | 4 | __ | __ | __ | ☐ Pass ☐ Fail |
| **TOTAL** | **62** | **__** | **__** | **__** | **☐ PASS ☐ FAIL** |

### Defects Found

| ID | Section | Issue | Severity | Status | Resolution |
|----|---------|-------|----------|--------|-----------|
| 1 | | | ☐ Critical ☐ High ☐ Medium ☐ Low | ☐ Open ☐ Fixed | |
| 2 | | | ☐ Critical ☐ High ☐ Medium ☐ Low | ☐ Open ☐ Fixed | |

### Sign-Off

- [ ] **QA Lead** approves this test execution: __________ (date: __)
- [ ] **Product Manager** approves release: __________ (date: __)
- [ ] **DevOps Lead** approves deployment: __________ (date: __)

---

**End of Acceptance Criteria Document**
