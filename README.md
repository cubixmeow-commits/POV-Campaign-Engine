# POV Campaign Engine

**A Claude Skill that converts real-world events into immersive, structurally gated narratives.**

Give it a news event, developing situation, or historical case. It researches the facts, selects the most structurally effective point of view, and outputs a complete piece that lets the reader experience the event in real time — knowing only what the POV knows, when they know it.

**Current output formats:**
- X thread
- Newsletter

## Design Contract

Everything in this engine follows one invariant: the audience may only know what the selected POV could reasonably know at that point in time. Every pipeline stage exists to preserve that constraint. Campaign Engine does not generate narratives from memory — it constructs them from verified reporting, then controls how that information is revealed.

## How It Works

The skill runs a 6-stage pipeline built on D&D campaign architecture:

```
Real Event → Operational Research → Structural Extraction → Campaign Design
    → Scene Ladder → Narrative Units → Output Format (X Thread / Newsletter)
```

1. **Operational Research** — 5–15 web searches build a verified factual substrate. Confirmed facts, disputed claims, and unknowns are labeled separately. Vivid details (prices, signs, street names, weather) are harvested for later placement.
2. **Structural Extraction** — Locations, actors, artifacts, ticking clocks, and escalation beats are extracted into a "game board."
3. **Campaign Design** — A POV is selected for maximum information-gap tension (close enough to see, far enough to not understand), access constraints are defined, and a 3–6 act structure is built around the structural pivot.
4. **Scene Ladder** — Acts are broken into playable encounters, each with a trigger, observable inputs, decision pressure, and withheld information.
5. **Unit Conversion** — Each scene becomes one narrative unit in the requested format: present tense, hook at the top, unresolved loop at the bottom.
6. **Assembly** — Frame unit, chronological units, and a final board-state unit with no resolution. Steps 1-4 are identical regardless of format; only 5-6 are format-specific (see `formats/`).

## The Two Engines

- **The Information Engine.** Tension comes from what is withheld. The reader inherits the POV's information gaps. The gap is the product.
- **The Detail Engine.** Immersion comes from verified sensory detail at full resolution. Nothing is invented. Everything real is rendered vividly.

## Design Highlights

- **POV selection guide** mapping event types to their most effective narrator (crime → local deputy, celebrity incident → bartender, corporate scandal → auditor)
- **Callback system** — 3–5 details introduced early return later with changed meaning
- **Hook/loop mechanics** — every post opens with a scroll-stopper and closes with unresolved pressure
- **Ethical boundaries** — no victim or perpetrator POVs, no invented facts, no dramatized suffering, verified reporting only

## Repo Structure

```
campaign-engine/
├── SKILL.md                      # Main skill definition and 6-stage workflow
├── input-template.md             # Schema for specifying an event, format, and constraints
├── references/                   # Format-independent pipeline stages
│   ├── research-template.md      # Research extraction categories + detail harvesting
│   ├── board-components.md       # Formats for locations, actors, artifacts, clocks, beats
│   ├── campaign-design.md        # POV selection, constraints, act structure, callbacks
│   └── scene-rules.md            # Breaking acts into scenes
├── formats/                      # Format-specific unit and assembly rules
│   ├── x-thread.md                # X post constraints (default format)
│   └── newsletter.md              # Newsletter section constraints
└── examples/
    └── README.md                 # Curated real-event roster, queued for full runs
```

The split matters: Steps 1-4 of the pipeline (research, extraction, campaign design, scene ladder) are identical no matter where the output lands. Only Step 5-6 (unit conversion and assembly) differ by format. That's why `references/` and `formats/` are separate directories — one holds the event modeling, the other holds the prose rules for a specific medium.

## Usage

Fill out `input-template.md`:

```
## Event
[the event]

## Output Format
- [x] X thread
```

Then run it through the skill. The output is a single markdown file in the requested format.

**A note on output paths:** `SKILL.md` tells Claude to write to `/mnt/user-data/outputs/` — that's Claude's own runtime working directory when it executes the skill, not a path in this repo. For this repo's purposes, generated runs live in `examples/`, organized one folder per event.

## Example Triggers

- "Run the campaign engine on [event]"
- "Turn this into a newsletter"
- "Build a campaign thread about [news story]"

## Roadmap

- Additional format specs (documentary beat sheet, podcast outline) — not yet built. Adding a format means writing a full `formats/*.md` spec with the same rigor as `x-thread.md`, not a stub.
- Saving intermediate pipeline artifacts (research notes, board, scene ladder) as separate inspectable files per run, rather than only the final output.
