# Example Roster

One of these five has now been run end to end: see `crowdstrike-outage/` for the complete pipeline output (research, board, campaign design, scenes, and final thread). The other four remain queued — a curated list of good candidates, not finished output. A repo full of placeholder outputs is worse than an honest to-do list.

Each was chosen for the same reason: real operational detail, a clean POV with a genuine information gap, and no need to dramatize a victim's suffering to make the story work. That last constraint matters — it's a hard boundary in `SKILL.md`, not a style choice.

| Event | Suggested POV | Format | Status |
|---|---|---|---|
| CrowdStrike global IT outage (July 2024) | On-call site reliability engineer | X thread | **Done — see `crowdstrike-outage/`** |
| Samsung Galaxy Note 7 recall (2016) | Regional electronics retail / logistics manager | X thread | Queued |
| Wirecard collapse (2020) | Internal auditor | Newsletter | Queued |
| Burning Man 2023 flooding | Event operations / emergency dispatcher | X thread | Queued |
| Tacoma Narrows Bridge collapse (1940) | Bridge inspector / engineer on site | Newsletter | Queued |

## Running one

Fill out `input-template.md` with the event name and desired format, then run it through the six-stage pipeline in `SKILL.md`. A completed run produces a single markdown file; it does not currently save the intermediate research/board/campaign artifacts as separate files; those exist only as the model's working state during generation.

If you want the intermediate stages saved as inspectable files (research notes, the board, the scene ladder) rather than only the final output, that's a real but separate change to the workflow — see the note in the main README under "Roadmap."
