# Campaign Design: CrowdStrike Falcon Outage

## POV Selection

**Selected POV: On-call site reliability engineer at an unnamed enterprise (composite, invented role — not a real person or real named company)**

Justification:
- Access to information: sees their own organization's fleet crash in real time, has access to internal monitoring and ticket systems, and receives external information only through the same channels the public uses (news, CISA alerts, Kurtz's public statements) — a textbook natural information gate.
- Exposure to tension: experiences the maximum-uncertainty window directly (Beats 1–3), not knowing at first whether this is a local failure, a targeted attack, or something larger.
- Movement across locations: while physically anchored at L1, the POV's information moves across multiple locations (L2 airport disruption, L3 hospital cancellations, L4 broadcast outages, L6 retail) entirely through news and public statements — satisfying the "3-4 locations" requirement through information access rather than physical travel, which matches the "technology failure" POV type in SKILL.md's guide (can see the system, not the cause).
- Ability to experience escalation beats: present for Beats 1–3 firsthand (their own fleet), and for Beats 4–8 through the same public channels available to everyone else — a believable mix of direct and secondhand exposure.

This avoids all five selection anti-patterns: not a victim, not CrowdStrike (which would collapse the information gate since they'd know the cause immediately), not omniscient, not a pure outsider (they have real skin in the outcome), not a minor.

## Player Constraints

**1. Accessible locations:** L1 (full access, their own operations center) throughout. L2, L3, L4, L6 — accessible only as information, via news/social media/CISA alerts, from Beat 4 onward.

**2. Inaccessible locations:** L5 (CrowdStrike HQ) — the POV never has physical or privileged access. Everything from L5 arrives through public statements only, same as any member of the public.

**3. Artifact visibility:**
- Visible: their own organization's crash logs and ticket queue (invented, not a real artifact, but a plausible one)
- Delayed: E1 (Channel File 291) — its existence becomes known only once CrowdStrike's preliminary review names it, days after the event; E2 (Kurtz's tweet) — visible same-day, once the POV checks outside channels
- Invisible: E3 (Root Cause Analysis) and E4 (Delta's legal complaint) are both outside this thread's timeframe — RCA published weeks later, complaint filed three months later. Neither is accessible to the POV within the story's active window.

**4. Clock visibility:**
- Visible to POV: C1 (technical remediation window) — they are living it
- Visible to POV: C2 (media cycle) — they can see the gap between CrowdStrike's messaging and their own lived experience
- Invisible to POV: C3 (Delta's outlier recovery) and C4 (legal clock) — both resolve outside the story's timeframe and were never part of the POV's direct experience

**5. Information Gating Matrix:**
- Immediately visible: their own fleet crashing, the BSOD loop, their own team's triage
- Unlockable: the cause (Channel File 291), once public reporting names it; the "not a cyberattack" confirmation, once CISA's alert lands
- Permanently hidden (within this thread): CrowdStrike's internal engineering process, the RCA's technical detail, the eventual litigation
- Structurally unknowable at the time: whether recovery will take hours or days for any given organization — this genuinely wasn't known by anyone in the first hours, POV included

## Act Structure

### ACT I: Undiagnosed Failure
**Beats:** 1, 2
**What fundamentally changes:** A routine on-call night becomes a mass-casualty-scale technical event with no known cause.
**What illusion collapses:** That this is a normal, isolated incident scoped to one organization.
**What tension increases:** Volume of alerts, uncertainty about whether this is an attack, inability to reach any authoritative source.
**What remains unresolved:** Cause, scope, and whether this is malicious.

### ACT II: Confirmation Without Relief
**Beats:** 3, 4
**What fundamentally changes:** The cause is identified (by CrowdStrike, not by the POV) and publicly confirmed as non-malicious.
**What illusion collapses:** That "identified and fixed" means "resolved" — for already-crashed systems, the technical fix at the source doesn't touch machines that already crashed.
**What tension increases:** The gap between the official message ("fixed") and the POV's own unresolved backlog of dead machines.
**What remains unresolved:** How long manual remediation of the POV's own fleet will take.

### ACT III: The Visible World
**Beats:** 5, 6
**What fundamentally changes:** The POV, now deep in manual remediation, starts seeing the outside scope of the event through news — airports, hospitals, broadcasters, all hit by the same thing they're fighting alone at their own desk.
**What illusion collapses:** That this is their problem alone. It is, structurally, everyone's problem simultaneously, and no one is coming to help them specifically.
**What tension increases:** The strange dissonance of watching a global story unfold about the exact failure sitting in front of you.
**What remains unresolved:** Whether their own organization will recover in hours (like most) or days (like Delta, though the POV doesn't yet know Delta will be the outlier).

## Structural Pivot

Beat 3 (05:27 UTC, CrowdStrike reverts the file) is the structural pivot for this POV specifically — before it, the POV has no idea what's happening or whether it will end. After it, the POV knows the cause and knows new damage has stopped, but also learns, in real time, that "stopped" and "fixed" are not the same thing for a machine that already crashed. That gap — between official resolution and lived resolution — is what the rest of the thread lives inside.

## Callback Planning

**Callback 1: The Blue Screen**
- Introduced in: Post 1 (frame), as the first thing the POV sees on their own monitor bank
- Returns in: final post, as the same screen still showing on a subset of machines that haven't been manually touched yet
- Shift in meaning: from "unknown emergency" to "known, named, and still not fully gone"

**Callback 2: "Not a cyberattack"**
- Introduced in: early post, as the fear driving the POV's first hour (is this an attack?)
- Returns in: a later post, once CISA's alert lands, as relief that curdles almost immediately into a different, duller problem (a vendor mistake is somehow less containable than an attack would have been, because there's no adversary to block)
- Shift in meaning: from "worst case averted" to "the actual case is just as bad, differently"

**Callback 3: The Southwest detail**
- Introduced in: a mid-thread post, as a strange piece of news the POV reads on their phone (Southwest's fleet untouched, unclear if by luck or by its older software)
- Returns in: the final post, as an unresolved irony sitting alongside the board state — the newest, most current systems failed; the oldest ones didn't
- Shift in meaning: stays a genuine unresolved irony, not moralized

Three callbacks, within the 3-5 range from campaign-design.md. All three are sourced from research.md, not invented.
