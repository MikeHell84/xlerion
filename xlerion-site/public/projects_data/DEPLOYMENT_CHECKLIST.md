# Deployment Checklist

## Estación Comunitaria Nocaima Demo Project

**Version:** 1.0  
**Last Updated:** February 4, 2025  
**Deployment Target:** Xlerion.com React SPA + PHP Backend

---

## Pre-Deployment Phase

### 1. Content Preparation

- [ ] **All JSON files validated**
  - [ ] `radio_nocaima_card.json` - Project card metadata
  - [ ] `radio_nocaima_demo_content.json` - Full demo content
  - Files validated with JSON schema validator
  - No syntax errors or malformed data

- [ ] **All images optimized**
  - [ ] Hero image: 1920x1080, < 200KB (WEBP + JPG fallback)
  - [ ] Thumbnails: 400x300px, < 50KB each
  - [ ] Episode thumbnails: 200x150px, < 30KB each
  - [ ] Event images: 600x400px, < 80KB each
  - All images in `/images/projects/` directory
  - All images have descriptive alt text

- [ ] **Demo audio files prepared**
  - [ ] 3 episode demo files (MP3, 128kbps)
  - [ ] 8 sound map audio files (MP3, 128kbps)
  - [ ] Stream URLs pointing to demo CDN
  - [ ] Audio files accessible and not region-locked
  - [ ] All files hosted on reliable CDN

- [ ] **Translation keys verified**
  - [ ] All Spanish copy approved
  - [ ] All English translations verified
  - [ ] No placeholder or untranslated text
  - [ ] Grammar and tone reviewed

### 2. Code Integration

- [ ] **React component created**
  - [ ] File: `src/pages/RadioNocaimaPage.jsx`
  - [ ] Import statements correct
  - [ ] Responsive design verified
  - [ ] CSS scoped or Tailwind classes used
  - [ ] No console errors or warnings

- [ ] **i18n keys added to LanguageContext.jsx**
  - [ ] All Spanish keys added
  - [ ] All English keys added
  - [ ] Keys follow naming convention
  - [ ] No duplicate key names

- [ ] **Route added to main.jsx**
  - [ ] Route path: `/projects/radio-nocaima-demo`
  - [ ] Component imported correctly
  - [ ] Route positioned in correct section

- [ ] **App.jsx updated**
  - [ ] Project card added to "Proyectos" section
  - [ ] Uses correct icon and layout
  - [ ] Demo badge visible
  - [ ] CTA links to correct route

- [ ] **Layout component integration**
  - [ ] Header properly displayed
  - [ ] Footer properly displayed
  - [ ] Navigation accessible
  - [ ] Breadcrumbs implemented

### 3. API/Backend Setup

- [ ] **PHP endpoints created (if using live backend)**
  - [ ] `/api/projects/radio-nocaima-demo` - GET
  - [ ] `/api/projects/radio-nocaima-demo/content` - GET
  - [ ] `/api/correspondents/submit` - POST
  - [ ] `/api/donations/initiate` - POST
  - [ ] `/api/analytics/event` - POST
  - [ ] `/api/streams/radio-nocaima/live` - GET
  - All endpoints return correct JSON responses

- [ ] **Database updates (if applicable)**
  - [ ] Projects table updated with new project
  - [ ] Database migrations applied
  - [ ] Indexes optimized for queries
  - [ ] Backup created before changes

- [ ] **Router.php updated**
  - [ ] New API routes registered
  - [ ] CORS headers properly configured
  - [ ] Content-Type headers correct
  - [ ] Rate limiting in place (if needed)

- [ ] **Demo fallback data configured**
  - [ ] Bundled JSON available for offline mode
  - [ ] Fallback activated if API unavailable
  - [ ] Service worker configured (if applicable)
  - [ ] Cache headers set correctly

### 4. Security Review

- [ ] **Input validation implemented**
  - [ ] Form inputs sanitized
  - [ ] File uploads validated (type, size)
  - [ ] URL parameters escaped
  - [ ] No SQL injection vulnerabilities

- [ ] **File upload security**
  - [ ] Max file size: 50MB for audio
  - [ ] Allowed types: MP3, WAV, FLAC
  - [ ] Files scanned for malware
  - [ ] Files stored outside web root

- [ ] **Authentication/Authorization**
  - [ ] Admin endpoints require token
  - [ ] Donation endpoints use HTTPS only
  - [ ] CORS policy restrictive
  - [ ] Rate limiting active

- [ ] **Privacy compliance**
  - [ ] Privacy policy linked in footer
  - [ ] GDPR compliance verified (if EU traffic)
  - [ ] Cookie consent implemented (if needed)
  - [ ] User data encryption in transit

- [ ] **Content Security Policy**
  - [ ] CSP headers configured
  - [ ] External scripts whitelisted
  - [ ] Inline scripts reviewed
  - [ ] No unsafe directives

---

## Testing Phase

### 5. Functional Testing

#### Browser Compatibility

- [ ] **Desktop Browsers**
  - [ ] Chrome (latest)
    - [ ] Hero renders correctly
    - [ ] Player controls work
    - [ ] Forms validate
    - [ ] Maps load
  
  - [ ] Firefox (latest)
    - [ ] All features functional
    - [ ] No console errors
    - [ ] Responsive layout correct
  
  - [ ] Safari (latest)
    - [ ] HLS stream plays
    - [ ] Animations smooth
    - [ ] Forms submit
  
  - [ ] Edge (latest)
    - [ ] All features work
    - [ ] No compatibility issues

- [ ] **Mobile Browsers**
  - [ ] iOS Safari (latest)
    - [ ] Touch controls responsive
    - [ ] Responsive layout correct
    - [ ] Forms usable on small screens
    - [ ] No horizontal scroll
  
  - [ ] Android Chrome (latest)
    - [ ] All features functional
    - [ ] Performance acceptable
    - [ ] Layout correct
  
  - [ ] Mobile Firefox
    - [ ] All features work
    - [ ] No issues specific to Firefox

#### Device Testing

- [ ] **Viewport Sizes**
  - [ ] 320px (mobile small)
  - [ ] 768px (tablet)
  - [ ] 1024px (desktop)
  - [ ] 1440px+ (large desktop)

#### Component Testing

- [ ] **Hero Section**
  - [ ] Image loads and displays correctly
  - [ ] Parallax effect works (desktop)
  - [ ] Text is readable (contrast)
  - [ ] CTA buttons clickable and lead to correct sections
  - [ ] Responsive layout works on all breakpoints

- [ ] **Live Player**
  - [ ] HLS stream initiates
  - [ ] Audio plays through player
  - [ ] Play/pause buttons work
  - [ ] Volume control works
  - [ ] Quality selector works (if multi-bitrate)
  - [ ] Current program info displays
  - [ ] Listener count updates
  - [ ] Fallback to MP3 if HLS fails
  - [ ] Player works on mobile

- [ ] **Episodes Section**
  - [ ] Episodes load and display
  - [ ] Pagination works
  - [ ] Search functionality works
  - [ ] Filter by category works
  - [ ] Sort options work
  - [ ] Episode play buttons work
  - [ ] Episode thumbnails load
  - [ ] Donation button visible
  - [ ] Mobile scroll smooth

- [ ] **Calendar Events**
  - [ ] Calendar displays current month
  - [ ] Events marked on correct dates
  - [ ] Event details show when clicked
  - [ ] Add to calendar button works
  - [ ] Map location shows correctly
  - [ ] Month navigation works
  - [ ] Mobile view readable

- [ ] **Correspondent Form**
  - [ ] All form fields display correctly
  - [ ] File upload accepts audio files
  - [ ] Conditional fields show/hide based on selection
  - [ ] Validation messages appear
  - [ ] Form submits successfully
  - [ ] Success message displays
  - [ ] Error handling works
  - [ ] WhatsApp link works on mobile

- [ ] **Sound Map**
  - [ ] Leaflet map loads
  - [ ] 8 markers display correctly
  - [ ] Markers are clickable
  - [ ] Audio plays from popup
  - [ ] Map zoom works
  - [ ] Map pan works
  - [ ] Mobile touch interaction works

- [ ] **Donation Section**
  - [ ] Donation options display
  - [ ] Select donation initiates flow
  - [ ] Stripe integration works (if live)
  - [ ] Payment processing works
  - [ ] Receipt generated
  - [ ] Transparency budget chart displays

- [ ] **Education Section**
  - [ ] Workshop cards display correctly
  - [ ] Enrollment CTA visible
  - [ ] Newsletter signup works
  - [ ] Links functional

- [ ] **Footer**
  - [ ] All links functional
  - [ ] Contact info correct
  - [ ] Social media links work
  - [ ] Metrics display correctly

### 6. Accessibility Testing

- [ ] **Keyboard Navigation**
  - [ ] Tab order is logical throughout page
  - [ ] All interactive elements reachable via keyboard
  - [ ] No keyboard traps
  - [ ] Focus indicators visible
  - [ ] Enter key works for buttons/forms

- [ ] **Screen Reader Testing**
  - [ ] Test with NVDA (Windows) or VoiceOver (Mac)
  - [ ] All images have descriptive alt text
  - [ ] Form labels properly associated
  - [ ] Page structure semantic (headings, landmarks)
  - [ ] Navigation is announccable
  - [ ] Dynamic content updates announced
  - [ ] Error messages clear

- [ ] **Color Contrast**
  - [ ] Text vs background: min 4.5:1 (WCAG AA)
  - [ ] Large text: min 3:1 (WCAG AA)
  - [ ] No information conveyed by color alone

- [ ] **WCAG 2.1 AA Checklist**
  - [ ] Perceivable: text resizable, sufficient contrast
  - [ ] Operable: keyboard accessible, enough time to interact
  - [ ] Understandable: predictable, clear language
  - [ ] Robust: compatible with assistive technologies

### 7. Performance Testing

- [ ] **Page Load Speed**
  - [ ] First Contentful Paint: < 2.5s
  - [ ] Largest Contentful Paint: < 4s
  - [ ] Cumulative Layout Shift: < 0.1
  - [ ] Time to Interactive: < 3.5s
  - [ ] Run Lighthouse audit: target score 85+

- [ ] **Asset Optimization**
  - [ ] Images optimized (WEBP + fallback)
  - [ ] Critical CSS inline
  - [ ] JavaScript minified/bundled
  - [ ] No unused dependencies
  - [ ] Unused imports removed

- [ ] **Mobile Performance**
  - [ ] Test on 4G throttling (Chrome DevTools)
  - [ ] FCP on 4G: < 4s
  - [ ] LCP on 4G: < 6s
  - [ ] Page usable on slow networks

- [ ] **Network Requests**
  - [ ] Total assets: < 5MB (without video)
  - [ ] HTML: < 200KB
  - [ ] CSS: < 150KB (after minify)
  - [ ] JavaScript: < 300KB (after minify)
  - [ ] Images: < 3MB total
  - [ ] No 4xx or 5xx errors in console

### 8. SEO Verification

- [ ] **Meta Tags**
  - [ ] Page title present and unique
  - [ ] Meta description present (150-160 chars)
  - [ ] OG:image present and valid
  - [ ] OG:title and OG:description set
  - [ ] Canonical URL set (if needed)

- [ ] **Structured Data**
  - [ ] Schema.org markup for event (event.json-ld)
  - [ ] Schema.org markup for media (creativework)
  - [ ] No structured data errors (Google Rich Results)

- [ ] **Sitemap & Robots**
  - [ ] URL added to sitemap.xml
  - [ ] Allow in robots.txt
  - [ ] Not marked as noindex

- [ ] **Internal Links**
  - [ ] Back links to main projects page
  - [ ] Cross-references to related projects
  - [ ] Breadcrumbs implemented

### 9. Analytics Verification

- [ ] **Event Tracking**
  - [ ] Track button clicks on project card
  - [ ] Track page views on demo page
  - [ ] Track player interactions
  - [ ] Track form submissions
  - [ ] Track donation button clicks
  - [ ] All events have correct payload

- [ ] **Analytics Integration**
  - [ ] Google Analytics events firing
  - [ ] Events visible in dashboard
  - [ ] Custom events properly categorized
  - [ ] No tracking errors in console

---

## Staging Environment

### 10. Staging Deployment

- [ ] **Files deployed to staging**
  - [ ] All JSON files in `/projects_data/`
  - [ ] Images in `/images/projects/`
  - [ ] React component in `/src/pages/`
  - [ ] Routes updated in `/src/main.jsx`
  - [ ] i18n keys in `LanguageContext.jsx`

- [ ] **Staging environment tests**
  - [ ] Full regression test suite passes
  - [ ] No errors in browser console
  - [ ] All links work and point to correct URLs
  - [ ] Database populated with demo data
  - [ ] Cache cleared, hard refresh successful

- [ ] **Staging sign-off**
  - [ ] Product owner reviews demo
  - [ ] Design review completed
  - [ ] QA sign-off obtained
  - [ ] Client approval (if applicable)

---

## Production Deployment

### 11. Production Rollout

- [ ] **Pre-deployment backup**
  - [ ] Database backup created
  - [ ] Current site snapshot taken
  - [ ] Rollback plan documented

- [ ] **Zero-downtime deployment**
  - [ ] Blue-green deployment or canary release
  - [ ] Health checks pass
  - [ ] No user-facing errors

- [ ] **DNS/CDN updates (if needed)**
  - [ ] CDN cache purged
  - [ ] DNS propagation complete
  - [ ] SSL certificates valid

- [ ] **Feature flag activation**
  - [ ] Demo project feature flag enabled
  - [ ] Gradual rollout (10% → 50% → 100%)
  - [ ] Monitor error rates during rollout

### 12. Post-Deployment Monitoring

- [ ] **Real User Monitoring**
  - [ ] Page load time tracking
  - [ ] Error rate < 0.1%
  - [ ] User session tracking
  - [ ] Conversion tracking

- [ ] **Infrastructure Monitoring**
  - [ ] Server CPU usage normal
  - [ ] Memory usage stable
  - [ ] Database query times < 500ms
  - [ ] No unusual API latency

- [ ] **Security Monitoring**
  - [ ] No suspicious login attempts
  - [ ] No malicious file uploads
  - [ ] WAF rules functioning
  - [ ] DDoS protection active

- [ ] **Error Tracking**
  - [ ] Sentry/similar tool monitoring errors
  - [ ] All errors logged and tracked
  - [ ] Critical errors trigger alerts
  - [ ] Error trends analyzed

- [ ] **24-hour stability check**
  - [ ] All systems running normally
  - [ ] No spike in error rates
  - [ ] Performance metrics stable
  - [ ] User feedback positive

---

## Post-Launch

### 13. User Feedback & Iteration

- [ ] **Collect user feedback**
  - [ ] Monitor comments/reviews
  - [ ] Track social media mentions
  - [ ] Surveys sent to users
  - [ ] Bug reports categorized

- [ ] **Quick fixes implemented**
  - [ ] Critical bugs hotfixed within 24h
  - [ ] Minor bugs scheduled for next release
  - [ ] User experience issues prioritized

- [ ] **Content updates**
  - [ ] Audio files refreshed regularly
  - [ ] Events calendar kept current
  - [ ] Episode library maintained
  - [ ] Correspondent stories published

### 14. Documentation & Knowledge Transfer

- [ ] **Developer documentation**
  - [ ] Deployment guide written
  - [ ] Architecture documented
  - [ ] API documentation up to date
  - [ ] Code comments clear

- [ ] **User documentation**
  - [ ] User guide for correspondents
  - [ ] FAQ section created
  - [ ] Help center articles written
  - [ ] Video tutorials recorded

- [ ] **Training completed**
  - [ ] Admin staff trained on CMS
  - [ ] Support team trained on system
  - [ ] Content team trained on publishing
  - [ ] Training materials documented

### 15. Maintenance Plan

- [ ] **Regular updates scheduled**
  - [ ] Security patches applied monthly
  - [ ] Dependency updates reviewed quarterly
  - [ ] Performance optimization ongoing
  - [ ] Content updates scheduled

- [ ] **Backup strategy**
  - [ ] Daily database backups
  - [ ] Weekly full system backups
  - [ ] Backups tested monthly
  - [ ] Disaster recovery plan documented

- [ ] **Version control**
  - [ ] All changes in git with clear messages
  - [ ] Feature branches for new work
  - [ ] Code reviews before merge
  - [ ] Tags for releases

---

## Rollback Plan (If Issues)

### Emergency Rollback Procedures

**If critical errors detected:**

1. [ ] Immediately disable feature flag
2. [ ] Revert code to previous commit
3. [ ] Clear CDN cache
4. [ ] Verify rollback complete
5. [ ] Alert stakeholders
6. [ ] Document root cause
7. [ ] Plan remediation

**Rollback Checklist:**

- [ ] Database restored from backup
- [ ] Files reverted to previous version
- [ ] Cache cleared completely
- [ ] DNS updated (if needed)
- [ ] Verification tests pass
- [ ] Users notified of resolution

---

## Sign-Off

| Role | Name | Date | Status |
|---|---|---|---|
| Developer | __________ | __________ | ☐ Approved |
| QA Lead | __________ | __________ | ☐ Approved |
| Product Manager | __________ | __________ | ☐ Approved |
| DevOps/Deployment | __________ | __________ | ☐ Approved |

---

## Notes & Issues

**Issues Found During Deployment:**

1. Issue: _________________________
   - Severity: ☐ Critical ☐ High ☐ Medium ☐ Low
   - Resolution: ________________________
   - Date Resolved: __________

2. Issue: _________________________
   - Severity: ☐ Critical ☐ High ☐ Medium ☐ Low
   - Resolution: ________________________
   - Date Resolved: __________

**Lessons Learned:**

- ...

**Follow-up Actions:**

- ...

---

**End of Deployment Checklist**
