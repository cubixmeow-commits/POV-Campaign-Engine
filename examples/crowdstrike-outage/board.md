# Board: CrowdStrike Falcon Outage

## LOCATIONS

**L1: Generic Enterprise IT Operations Center (POV's location)**
- Type: private/commercial, internal network operations center
- Access level: restricted (employees, on-call staff only)
- Known movement: POV is on-call and reachable by phone/pager starting in the small hours of July 19, 2024
- Verified details: composite/generic — this location is not a real, named company. Environmental details (monitoring dashboards, ticket queues, Slack/on-call tooling) are standard enterprise IT operations conventions, not invented specifics about any real organization.

**L2: Hartsfield-Jackson Atlanta International Airport**
- Type: public transit hub
- Access level: public (terminals), restricted (operations areas)
- Known movement: became the epicenter of the Delta disruption; North Terminal saw crowding and tense crowd control early July 19; unclaimed bags piled in the South Terminal baggage area for days after
- Verified details: North Terminal crowd control "got testy" per AJC; South Terminal baggage area filled with unclaimed bags; Delta later opened an internal Baggage Command Center in Atlanta

**L3: US Hospital Systems (composite, 12+ real institutions)**
- Type: healthcare facilities
- Access level: restricted (clinical/admin systems), public (main entrances, emergency departments which stayed open)
- Known movement: institutions including Mass General Brigham, Cleveland Clinic, Cincinnati Children's, Mount Sinai, Nationwide Children's, and Ohio State Wexner canceled non-urgent surgeries and procedures; emergency departments remained open throughout
- Verified details: institutional statements only, no named private patients per this run's constraints

**L4: Broadcast Studios (Sky News UK, Australian networks, US affiliates)**
- Type: commercial/media
- Access level: restricted (studio floors), effects visible publicly (dead air, backup programming)
- Known movement: Sky News UK off air for a stretch of the morning, returned "without full capabilities"; ESPN, several Paramount channels, and Australian broadcasters all reported outages
- Verified details: ESPN aired an ESPN Radio simulcast in place of SportsCenter; MeTV Toons off air 5.5 hours

**L5: CrowdStrike HQ, Austin, Texas**
- Type: corporate headquarters
- Access level: restricted, digital-only from POV's perspective (POV never physically accesses this location — only its outputs: tweets, blog posts, the RCA)
- Known movement: internal engineering identified and reverted the faulty file at 05:27 UTC; George Kurtz posted the first public acknowledgment same day
- Verified details: known only through public communications, not through direct POV access — this is the correct information-gating boundary

**L6: Retail point-of-sale terminals (Sydney, Brisbane, and elsewhere)**
- Type: commercial, public-facing
- Access level: public
- Known movement: cash registers displaying the Blue Screen of Death, photographed and widely circulated
- Verified details: photographed BSOD screens on registers, per Al Jazeera/Reuters/AAP captions

## ACTORS

**A1: The POV — On-call site reliability engineer**
- Controls: their own organization's fleet triage, escalation, and remediation queue
- Does not control: CrowdStrike's engineering response, the global scope of the event, any other organization's systems
- Public visibility: none (invented, unnamed role — not a real person)
- Verified details: none — this actor is a narrative device, not a real individual. Everything they observe about the outside world is drawn from the sourced facts above.

**A2: George Kurtz, CrowdStrike President & CEO**
- Controls: CrowdStrike's public communications and technical response
- Does not control: how fast individual affected organizations can manually remediate their own fleets
- Public visibility: high
- Verified details: posted the first public X acknowledgment; told NBC's TODAY show recovery "could be some time" for some systems (paraphrase; direct quote in research.md is under 15 words per copyright limits)

**A3: CISA**
- Controls: public alerting and coordination with CrowdStrike and government partners
- Does not control: private-sector remediation speed
- Public visibility: medium (visible to anyone tracking official channels, not to the general public by default)
- Verified details: issued the first alert at 11:30 a.m. EDT, confirming non-malicious cause

**A4: Delta Air Lines**
- Controls: its own recovery timeline and public statements about the outage
- Does not control: CrowdStrike's technical response or Microsoft's Azure-side recovery
- Public visibility: extreme (by end of the event, due to being the visible outlier in recovery time)
- Verified details: 7,000 cancellations over five days; later sued CrowdStrike alleging gross negligence

**A5: Affected hospital systems (composite/institutional)**
- Controls: their own decision to cancel non-urgent procedures
- Does not control: the underlying software fix
- Public visibility: medium (institutional statements, not individual visibility)
- Verified details: institutional public statements only

## ARTIFACTS

**E1: Channel File 291 (C-00000291*.sys)**
- Location found: L5 (CrowdStrike HQ, digital)
- Chain of custody: deployed 04:09 UTC, identified as faulty and reverted by CrowdStrike engineering at 05:27 UTC
- Current status: publicly documented in the Root Cause Analysis; the flawed timestamp version is retired

**E2: George Kurtz's initial X post**
- Location found: public, digital (X/Twitter)
- Chain of custody: posted by Kurtz July 19, 2024, archived publicly
- Current status: public record

**E3: CrowdStrike's Root Cause Analysis report**
- Location found: public, digital (CrowdStrike's own site)
- Chain of custody: published Aug 7, 2024, after a preliminary review on July 24
- Current status: public document, final

**E4: Delta's legal complaint**
- Location found: Fulton County Superior Court, Georgia
- Chain of custody: filed Oct 25, 2024
- Current status: active litigation; some claims dismissed May 2025, others (gross negligence, computer trespass) allowed to proceed

## TICKING CLOCKS

**C1: Technical remediation window**
- Type: operational
- Description: any system freshly booting after 05:27 UTC / 1:27 a.m. ET would not pick up the faulty file, but already-crashed systems needed manual, one-by-one Safe Mode remediation, which does not scale automatically.

**C2: Media cycle / reputational**
- Type: media
- Description: the visible gap between "fixed in 79 minutes" (CrowdStrike's framing) and the days-long recovery some organizations experienced put pressure on CrowdStrike's public narrative in real time.

**C3: Delta's outlier recovery**
- Type: operational / narrative
- Description: while most airlines recovered within a day, Delta's recovery stretched to five days, creating a widening, publicly visible gap between Delta and its peers that eventually became a legal dispute over responsibility.

**C4: Legal clock**
- Type: legal
- Description: the three-month gap between the incident and Delta filing suit, during which both companies exchanged legal threats before formal litigation began.

## ESCALATION BEATS

**Beat 1: July 19, 2024, 04:09 UTC**
- What changed: Channel File 291 deployed with the logic flaw
- Opened: the failure condition itself, though invisible to anyone at this moment
- Closed: nothing yet — this is the origin point, not yet detected

**Beat 2: July 19, 2024, ~04:30–05:00 UTC (approximate, based on onset reporting)**
- What changed: Windows systems running the sensor begin crashing into BSOD/boot loops worldwide
- Opened: the operational crisis — IT teams globally begin discovering mass simultaneous failures
- Closed: any assumption that this is an isolated, single-organization problem

**Beat 3: July 19, 2024, 05:27 UTC**
- What changed: CrowdStrike identifies the cause internally and reverts the file
- Opened: the possibility of recovery for any system rebooting fresh from this point on
- Closed: the window during which new systems could still be affected

**Beat 4: July 19, 2024, 11:30 a.m. EDT**
- What changed: CISA's public alert confirms the cause and rules out malicious activity
- Opened: public, official confirmation that this is not a cyberattack
- Closed: the early hours of ambiguity and cyberattack speculation

**Beat 5: July 19, 2024, mid-morning**
- What changed: United, Delta, and American issue a coordinated ground stop
- Opened: the aviation-specific crisis becomes visible to the traveling public
- Closed: any assumption the outage would stay contained to back-office systems

**Beat 6: July 19–22, 2024**
- What changed: CrowdStrike and Microsoft jointly push remediation guidance; most organizations recover within days
- Opened: the recovery phase for the majority of affected organizations
- Closed: the acute global crisis phase, for most sectors

**Beat 7: July 24–25, 2024**
- What changed: Delta alone remains disrupted five days after the initial event, while peers have fully recovered
- Opened: public scrutiny specifically of Delta's IT infrastructure and DOT's investigation
- Closed: the narrative that this was a uniform, evenly-distributed global event — it becomes a story about one outlier

**Beat 8: October 25, 2024**
- What changed: Delta files suit against CrowdStrike
- Opened: the legal phase of the story, a dispute over responsibility that outlives the technical incident
- Closed: the possibility of an informal resolution between the two companies

## Structural Pivot

**Beat 7** (Delta's outlier recovery becoming visible, July 24–25) is the structural pivot. Before this beat, the story is "a global outage, resolved within days for almost everyone." After this beat, the story bifurcates: a closed technical incident for most of the world, and an open, adversarial dispute over blame for one specific company. The change is irreversible because it moves the story out of the realm of shared technical fact (the RCA, which both sides accept) and into contested legal and reputational territory that neither company controls unilaterally.

## Analytical Identifications

- **Highest-information-density act:** Beats 1–4 (the first ~7 hours), where the technical cause, the scale, and the "not a cyberattack" confirmation all land in rapid succession. Data quality: high — this period is the most cross-referenced across independent sources.
- **Most isolating act for the POV:** Beats 1–3, before CISA's alert. The POV can see their own fleet crashing in real time but has no way to know yet whether this is an isolated incident, a targeted attack, or something global. This is the highest-tension window precisely because the POV has maximum uncertainty about scope and cause.
