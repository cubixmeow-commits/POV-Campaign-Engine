---
name: pov-campaign-engine
description: "Converts real-world events into structurally gated experiential narratives using campaign architecture, output as either an X thread or a newsletter issue. Use this skill whenever the user provides a real-world event, news story, developing situation, or case and wants it converted into an immersive thread or newsletter. Also trigger when the user says 'run the campaign engine', 'build a campaign thread', 'turn this into a thread', 'make this a newsletter', or references the Campaign Engine format. This skill handles the entire pipeline: operational research, structural extraction, campaign design, scene-to-unit conversion, and assembly. The user provides a topic (and optionally a format); the skill outputs a complete markdown file in that format. See input-template.md for the full input schema."
---

# POV Campaign Engine

Convert verified real-world events into immersive, structurally gated narratives. Output format is selected per run — see `formats/`.

## Design Contract

Everything in this engine follows one invariant:

**The audience may only know what the selected POV could reasonably know at that point in time.**

Every stage of the pipeline exists to preserve this constraint. The format the output takes — X thread, newsletter, or a future format — changes the unit boundaries and voice mechanics. It never changes this contract.

```
Real Event
    │
    ▼
Operational Research
    │
    ▼
Structural Extraction
    │
    ▼
Campaign Design
    │
    ▼
Scene Ladder
    │
    ▼
Narrative Units  ◄── format-specific from here down
    │
    ▼
Output Format
 ├── X Thread
 └── Newsletter
```

Campaign Engine does not generate narratives from memory. It constructs them from verified reporting, then controls how that information is revealed through a constrained point of view.

## What This Skill Does

Takes a real-world event or developing situation and runs it through a 6-stage pipeline:

1. **Operational Research** : Web search to build a verified factual substrate
2. **Structural Extraction** : Extract locations, actors, artifacts, clocks, escalation beats
3. **Campaign Design** : Select POV, define access constraints, build act structure
4. **Scene Ladder** : Break acts into playable encounters
5. **Unit Conversion** : Convert scenes into narrative units in the requested format
6. **Assembly** : Format as a complete output — see `formats/` for the format-specific structure

The output is a single markdown file. Current formats: X thread (default), newsletter.

## Core Principles

### The Two Engines

This skill runs on two engines simultaneously:

1. **The Information Engine.** Tension comes from what is WITHHELD, not what is described. The reader inherits the POV's information gaps. The gap is the product.

2. **The Detail Engine.** Immersion comes from verified sensory detail placed at full resolution. Real names of real places. Real prices on real menus. Real signs on real walls. Real weather on real streets. Every detail must come from research. Nothing is invented. But everything that is real is rendered vividly.

### The Callback System

Narrative units reward audiences who stay with the piece. Callbacks are the reward mechanism.

A callback is when a detail introduced early reappears later in a different context. A sidewalk used for photos becomes a sidewalk used for a restraint. A barber chair mentioned in the frame unit sits empty in the final act. A phrase someone said early echoes when the subject is on the ground somewhere else.

Callbacks are not decorative. They are structural. They create the feeling that the output is a single coherent experience, not a series of disconnected units.

Rules for callbacks:
- Introduce the detail naturally in its first appearance. Do not signal that it will return.
- When the detail reappears, do not announce the callback. Let the reader feel it.
- Limit to 3-5 callbacks per output (fewer for formats with longer, less frequent units — the relevant `formats/` file gives the exact number).
- The best callbacks change meaning between appearances. Same detail, different weight.

### The Hook and Loop System

Every narrative unit must work as a standalone piece. That means:

**Hook:** The opening of every unit must earn the audience's attention immediately. This is not clickbait. It is a concrete, specific, interesting fact or image that makes the reader want the next line. The hook is always a verified detail, never a tease. The exact mechanics (a scroll-stopping first line, a subject line, etc.) are format-specific — see the relevant `formats/` file.

**Loop:** The end of every unit must leave something unresolved. An unanswered question. A pending result. An operation in progress. A clock still running. A fact the POV does not know. The loop pulls the reader into the next unit.

## Style Discipline

The prohibitions, voice rules, and layout mechanics (em dashes, hashtags, white space, pacing) are format-specific and live in `formats/`, not here, because they differ by medium — a newsletter and an X thread do not share the same white-space or length conventions. The one rule that is never format-specific: **information gating must be preserved.** The reader only knows what the POV knows at that moment, regardless of what format the output takes.

## Core Workflow

### Step 1: Research the Event

Use web_search extensively (5-15 searches). Build a factual substrate.

**Research rules:**
- Use multiple sources. Cross-reference.
- Separate confirmed facts from disputed claims from unknowns.
- Record specific: dates, times, locations, names, distances, physical descriptions.
- Actively hunt for vivid verified details: prices, signs, physical descriptions of rooms, street names, weather, what people were wearing, names of staff, names of businesses, distances between locations.
- Do NOT interpret motive.
- Do NOT predict outcomes.
- Label unknowns explicitly.

**Detail harvesting (NEW in V2):**

During research, maintain a separate running list of vivid verified details. These are the raw materials for immersion. Examples:
- "The bar has at least fifty Cash Only signs"
- "$4 High Lifes"
- "Haircut and a shot, ten dollars, Mondays only"
- "Wraparound balcony on the second floor"
- "Handmade bean costumes"
- "Custom-decorated Beanmobile"
- "Video poker machines in the corner"

These details will be placed into narrative units during Step 5. They must all be sourced. They must all be real.

Read `references/research-template.md` for the extraction categories.

### Step 2: Structural Extraction

From the research, extract the board components. Read `references/board-components.md` for exact formats.

Extract:
- **LOCATIONS (L1 to Ln):** Every physical or digital location with type, access level, known movement
- **ACTORS (A1 to An):** Every actor/group with what they control, don't control, visibility level
- **ARTIFACTS (E1 to En):** Every physical/digital evidence item with location, chain of custody, status
- **TICKING CLOCKS (C1 to Cn):** Every time-sensitive constraint (biological, forensic, legal, media, evidence degradation)
- **ESCALATION BEATS (Beat 1 to n):** Every structural shift with date, what changed, what opened/closed

### Step 3: Campaign Design

Read `references/campaign-design.md` for the full framework.

**3a. Select POV.** Choose the single most structurally effective point of view. Selection criteria:
- Maximum uncertainty zone (knows more than public, less than lead investigators)
- Physical access to multiple locations
- Exposure to escalation beats (firsthand or through briefing)
- Natural information gating (can see some things, not others)

Do NOT choose POV for emotional impact. Choose for information-gap tension.

**3b. Define player constraints.** For the selected POV:
- Accessible locations
- Inaccessible locations
- Visible artifacts
- Delayed-access artifacts
- Invisible artifacts
- Visible clocks
- Invisible clocks

**3c. Build act structure.** Group escalation beats into 3-6 acts. For each act:
- What fundamentally changes
- What illusion collapses
- What tension increases
- What remains unresolved

**3d. Identify the structural pivot.** The moment after which the case is no longer the same kind of case.

**3e. Plan callbacks.** From the harvested detail list, identify 3-5 details that can serve double duty. A location, object, phrase, or image that appears early and returns later with changed meaning. Map where each callback is introduced and where it lands.

### Step 4: Scene Ladder

Break each act into 3-6 scenes. Read `references/scene-rules.md` for the format.

Each scene requires:
- Physical location (from extracted locations only)
- Trigger event
- Observable inputs (what POV physically sees/hears/is told)
- Decision pressure (operational tension)
- Information withheld (what POV does NOT know)
- End condition (what changes)

Every scene must either: collapse an illusion, increase uncertainty, narrow geography, or introduce a new information bottleneck.

### Step 5: Unit Conversion

Convert each scene into one narrative unit in the requested output format. Read the matching file in `formats/` before writing — it is the source of truth for this step, not a supplement to it:
- `formats/x-thread.md` — one scene becomes one X post (default if no format is specified)
- `formats/newsletter.md` — one scene becomes one longer-form section

Steps 1-4 (research, extraction, campaign design, scene ladder) do not change based on output format. The event, the POV, the information gating, and the act structure are identical regardless of where the output lands. Only the unit boundaries, pacing, and voice mechanics in Step 5 and 6 are format-specific, and they are fully specified in the format file — not duplicated here. If a requested format has no corresponding file in `formats/`, say so rather than improvising one. See `input-template.md` for how format requests are specified.

Every unit, regardless of format, contains:
- What is happening (present tense, observable)
- What is visible (physical, sensory, verified details at full resolution)
- What is said in briefing (if applicable, paraphrased, not invented dialogue)
- What is not yet known (stated as absence, not as mystery)
- What must happen next (implied by the operational state, not stated as narration)
- Verified environmental detail that places the reader inside the scene

### Step 6: Assembly

Assemble the complete output as a markdown file. The exact structure (what the frame unit contains, how many units, what the final unit contains) is specified in the same `formats/` file used in Step 5 — `formats/x-thread.md` for X threads, `formats/newsletter.md` for newsletters.

Output the result as a single `.md` file to `/mnt/user-data/outputs/`.

## POV Selection Guide

Best POVs by event type:

| Event Type | Best POV | Why |
|-----------|---------|-----|
| Crime/disappearance | First responder / local deputy | Maximum uncertainty zone |
| Celebrity incident | Service worker / bartender / staff | Proximity without insider access |
| Political crisis | Mid-level staffer / bureaucrat | Sees orders, not reasons |
| Military/conflict | Forward observer / medic | Physical proximity, no strategic view |
| Corporate scandal | Compliance officer / auditor | Sees the numbers, not the decisions |
| Natural disaster | Emergency dispatcher / local official | Information overload, action required |
| Technology failure | On-call engineer / operations | Can see the system, not the cause |

The universal principle: choose the POV that is **close enough to see and far enough to not understand.**

## Voice and Style

### Expressive Voice

The narrator can react. The reader should feel what the POV feels, not just infer it from a list of facts.

When the situation is absurd, the prose can register the absurdity. When the situation is escalating, the mounting pressure can show up in the writing, not only in the plot. When the situation is frightening or upsetting, the narrator is allowed to sound frightened or upset.

This is bounded in two ways, detailed fully in each format's own file: reactions must stay grounded in what the POV actually witnessed (no invented feelings standing in for invented facts), and the narrator never passes moral judgment on real people's actions. Feeling something and litigating it are different, and only the first is in bounds.

### Sentence Rhythm

Short declarative sentences are the default. Subject. Verb. Object.

But rhythm means variation. A sequence of short sentences can be followed by one longer sentence that carries the weight of what came before. Then back to short.

The rhythm should feel like breathing. Inhale on the short lines. Exhale on the longer ones.

### Verified Detail Placement

Place verified details where they do the most work:
- In the frame unit, to establish the physical world
- At the top of narrative units, as hooks
- At transition points, to ground the reader before a shift
- In callbacks, to create resonance

Never stack details. One or two per paragraph. Let each one land.

## Critical Boundaries

### For Active/Ongoing Events
- State clearly in the frame unit that the event is active/ongoing
- Do not resolve anything
- Do not imply outcomes
- Do not invent facts to fill gaps
- Label all unknowns

### For Sensitive Events (missing persons, casualties, active conflict)
- Use only verified reporting
- Do not dramatize suffering
- Do not invent sensory details about victims
- Do not write from the victim's POV
- Do not write from the suspect/perpetrator's POV
- Maintain the information gating. The restraint IS the technique.

### For Historical/Resolved Events
- The same pipeline applies but the final unit can include resolution
- Information gating still applies scene-by-scene (reader learns what POV learns when POV learns it)
- Do not front-load the conclusion

### For Celebrity/Public Figure Events
- Use only verified public reporting and official statements
- Do not speculate on mental state, sobriety, or motivation
- State observable facts (what witnesses reported, what police stated)
- Let the structural gap between public persona and documented behavior create the tension
- Do not editorialize on the gap. State both sides. The reader will do the rest.

## What Makes This Work

Three things, working together:

1. The tension comes from what is WITHHELD. The reader inherits the POV's information gaps. They feel escalation because they can see the operation and do not know what is inside. The gap is the product.

2. The immersion comes from what is REAL. Verified detail at full resolution makes the reader feel present. A "$4 High Life" does more work than a paragraph of invented atmosphere. The real is always more vivid than the imagined.

3. The engagement comes from what is UNDERSTATED. The voice refusing to match the escalation is what makes the reader lean in. They supply the emotion the narrator withholds. That is the contract.

## Reference Files

### input-template.md
The schema a user fills out to start a run: event, sources, status, output format, POV override, constraints.
**When to read:** Before Step 1, to know what's been specified versus what the engine needs to determine itself.

### references/research-template.md
Categories and format for operational research extraction. Includes detail harvesting protocol.
**When to read:** Always. First step of every run.

### references/board-components.md
Exact format specifications for locations, actors, artifacts, clocks, and escalation beats.
**When to read:** During Step 2 (structural extraction).

### references/campaign-design.md
Full framework for POV selection, player constraints, act structure, structural pivot identification, and callback planning.
**When to read:** During Step 3 (campaign design).

### references/scene-rules.md
Format and rules for breaking acts into scenes and converting scenes into units.
**When to read:** During Step 4 (scene ladder), format-independent.

### formats/x-thread.md
Exact constraints for writing X posts and assembling the final thread. Includes hook/loop system, flat-delivery examples, and callback placement rules. Default format.
**When to read:** During Steps 5 and 6, when the output format is an X thread.

### formats/newsletter.md
Exact constraints for writing newsletter sections and assembling the final issue. Same information-gating and flat-delivery principles as x-thread.md, adapted for longer units and inbox pacing.
**When to read:** During Steps 5 and 6, when the output format is a newsletter.
