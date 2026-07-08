# Example Run: CrowdStrike Falcon Outage

The first real, complete run through the engine. Format: X thread. Event: the July 19, 2024 CrowdStrike Falcon sensor outage.

## Files, in pipeline order

1. `input.md` — what was specified going in
2. `research.md` — Step 1 output (5 web searches, cross-referenced, confidence-labeled)
3. `board.md` — Step 2 output (locations, actors, artifacts, clocks, escalation beats)
4. `campaign.md` — Step 3 output (POV justification, constraints, act structure, callbacks)
5. `scenes.md` — Step 4 output (scene ladder)
6. `output-thread.md` — Steps 5-6 output, the final thread

## One editorial decision worth flagging

Several sources covering this event named a specific private individual and their canceled medical procedure. That's a real person's private medical emergency, not public-figure material, so it's deliberately excluded — the piece uses only institutional-level facts for the healthcare angle (which hospitals canceled which categories of procedures). This is noted in `input.md` as a constraint set before research began.

## POV note

The POV (an on-call site reliability engineer) is an invented, unnamed composite role, not a real person or a real named company. This matches SKILL.md's POV selection guidance for technology-failure events and avoids attributing invented internal actions to any specific real organization. Everything the POV observes about the outside world (Kurtz's statements, CISA's alert, Delta's recovery timeline, hospital statements, broadcaster outages) is drawn directly from `research.md`.
