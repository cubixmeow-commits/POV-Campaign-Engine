# Scene Ladder: CrowdStrike Falcon Outage

## ACT I: Undiagnosed Failure

### Scene 1.1: The First Alerts
- **Location:** L1
- **Trigger:** Monitoring system begins firing crash alerts in volume, shortly after 04:09 UTC
- **Observable inputs:** Alert count climbing on the dashboard; the pattern is identical across machines (BSOD, reboot, BSOD again); no single point of failure visible
- **Verified details available:** Blue Screen of Death behavior, boot-loop pattern
- **Decision pressure:** Whether to treat this as routine (a bad patch, common enough) or escalate immediately as a major incident
- **Information withheld:** Cause, scope beyond their own fleet, whether this is isolated
- **End condition:** POV escalates to major incident status; the queue is now too large to be routine
- **Callback placement:** Callback 1 (the Blue Screen) introduced here

### Scene 1.2: The Fleet Check
- **Location:** L1
- **Trigger:** POV pulls the full fleet status to gauge scale
- **Observable inputs:** A meaningful fraction of Windows endpoints down simultaneously; all running the same security sensor
- **Verified details available:** the pattern of "every affected machine runs Falcon" starts to become visible from the POV's own data, mirroring what CrowdStrike's own engineering would separately discover
- **Decision pressure:** Whether the common thread (the security sensor) is the cause or a coincidence
- **Information withheld:** Whether other organizations are seeing the same pattern; whether this is a targeted attack on their sensor specifically
- **End condition:** POV can no longer treat this as an isolated internal problem; the sensor is the common denominator
- **Callback placement:** none

### Scene 1.3: The First Outside Signal
- **Location:** L1 (digital access to outside world)
- **Trigger:** POV checks a phone, sees early social media chatter describing the same symptom elsewhere
- **Observable inputs:** Scattered, unconfirmed reports of similar crashes at other organizations; no official statement yet from anyone
- **Verified details available:** the earliest hour of the event was, per research, genuinely ambiguous even to outside observers
- **Decision pressure:** Whether to keep working the problem alone or wait for outside confirmation that might not come soon
- **Information withheld:** Official cause; whether this is a cyberattack (the fear explicitly present in contemporaneous reporting, e.g. the Y2K comparison)
- **End condition:** POV now knows this is bigger than their own organization but has no official explanation
- **Callback placement:** Callback 2 ("not a cyberattack") introduced here as the live, unresolved fear

## ACT II: Confirmation Without Relief

### Scene 2.1: The Vendor Posts
- **Location:** L1 (digital access to L5's output)
- **Trigger:** George Kurtz's public statement lands
- **Observable inputs:** The statement naming a defect in a content update, ruling out malicious activity, confirming Mac/Linux unaffected
- **Verified details available:** Kurtz's public X post (paraphrased, not quoted at length per copyright limits)
- **Decision pressure:** Relief at "not an attack" colliding immediately with the fact that the statement does nothing to fix the POV's own already-crashed machines
- **Information withheld:** How CrowdStrike found the cause; what "a fix has been deployed" actually means for machines already down
- **End condition:** The cyberattack fear is resolved; a new, duller problem (manual recovery) replaces it
- **Callback placement:** Callback 2 lands here — relief curdling into a different kind of bad news

### Scene 2.2: The Official Word
- **Location:** L1 (digital access to A3's output)
- **Trigger:** CISA's public alert, 11:30 a.m. EDT
- **Observable inputs:** Government confirmation of the same account CrowdStrike gave
- **Verified details available:** CISA's alert timing and content
- **Decision pressure:** None new operationally — this scene is about narrowing uncertainty, not adding urgency
- **Information withheld:** Total global scope (still not fully known even to CISA at this point); how long recovery will take elsewhere
- **End condition:** The "is this an attack" question is now closed for good, publicly and officially
- **Callback placement:** none

### Scene 2.3: The Manual Queue
- **Location:** L1
- **Trigger:** POV realizes the fix does not reach machines already crashed
- **Observable inputs:** Each affected machine needs someone to physically or remotely boot it into Safe Mode and delete one file, one at a time
- **Verified details available:** the specific manual remediation steps reported industry-wide
- **Decision pressure:** How to triage which machines get fixed first with limited hands
- **Information withheld:** How many machines, industry-wide, are stuck in the same queue; whether their own recovery will be measured in hours or days
- **End condition:** The scale of manual labor ahead becomes concrete instead of abstract
- **Callback placement:** none

## ACT III: The Visible World

### Scene 3.1: The Ground Stop
- **Location:** L1 (digital access to L2)
- **Trigger:** News of the coordinated airline ground stop
- **Observable inputs:** Reports of grounded aircraft, thousands of cancellations building through the morning
- **Verified details available:** the ~1,500 US cancellations reported by mid-morning, the North Terminal crowding at Hartsfield-Jackson
- **Decision pressure:** None directly — this scene is about the POV recognizing their own small crisis as one cell in a much larger grid
- **Information withheld:** Which airlines will recover fastest; that one of them (unnamed here) will still be dealing with this five days later
- **End condition:** The event is now visibly, undeniably global in scale
- **Callback placement:** Callback 3 (the Southwest detail) introduced here as an odd, unexplained exception in the reporting

### Scene 3.2: The Hospitals
- **Location:** L1 (digital access to L3)
- **Trigger:** Institutional statements from hospital systems begin circulating
- **Observable inputs:** Statements about canceled non-urgent procedures, emergency departments remaining open
- **Verified details available:** the institutional facts from research.md, no named patients
- **Decision pressure:** None directly for the POV — this scene widens the frame rather than adding a task
- **Information withheld:** Any specific patient outcomes (deliberately not pursued, per this run's constraints)
- **End condition:** The POV understands the event has consequences beyond IT inconvenience
- **Callback placement:** none

### Scene 3.3: Dead Air
- **Location:** L1 (digital access to L4)
- **Trigger:** POV notices a TV or radio also affected, or reads about Sky News going dark
- **Observable inputs:** Sky News off air, later returning "without full capabilities"; ESPN's SportsCenter replaced by a radio simulcast
- **Verified details available:** the specific broadcaster details from research.md
- **Decision pressure:** None operational — this scene is tonal, the moment the event stops feeling like an IT problem and starts feeling like an atmosphere
- **Information withheld:** none new
- **End condition:** The ambient, everywhere-at-once quality of the event is now unmistakable
- **Callback placement:** none

### Scene 3.4: What's Left Running
- **Location:** L1
- **Trigger:** Shift nearing its end; most of the POV's own fleet is back, a residual queue remains
- **Observable inputs:** A dashboard mostly green, a handful of machines still on the blue screen, waiting for hands that haven't reached them yet
- **Verified details available:** the reality that recovery, industry-wide, was uneven and partial for days after the technical fix
- **Decision pressure:** Positional — the POV's shift is ending, and the residual queue becomes someone else's problem next
- **Information withheld:** Whether the remaining machines will be fixed by the next shift or the one after
- **End condition:** The scene, and the campaign, ends without resolution — some machines still down, no announcement of full recovery
- **Callback placement:** Callback 1 (the Blue Screen) lands here — the same screen, now named and explained, still glowing on the machines no one has reached yet. Callback 3 (Southwest) also lands here, unresolved.

## Pacing Note

Per scene-rules.md: Act I scenes run slightly longer (more setup, the POV's world before the event has a name). Act II accelerates (more information per scene). Act III contracts toward the end, with Scene 3.4 deliberately the tightest and most information-dense, ending on the callbacks without resolving them.
