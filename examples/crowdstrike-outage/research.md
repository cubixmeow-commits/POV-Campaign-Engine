# Research: CrowdStrike Falcon Outage, July 19, 2024

## Geographic Data
- Primary location: Global. Concentrated impact in the US, UK, Australia, continental Europe. CONFIRMED
- CrowdStrike HQ: Austin, Texas. CONFIRMED
- Secondary locations: Airports (Heathrow, Gatwick, Edinburgh, Schiphol, Zurich, Berlin Brandenburg, Toronto Pearson, Hong Kong, Athens, Heraklion), hospitals (12+ US systems), broadcast studios (Sky News UK, NBC affiliates, Australian networks), Hartsfield-Jackson Atlanta (Delta's hub). CONFIRMED
- Access boundaries: Public-facing effects (departure boards, cash registers, TV broadcasts) vs. internal-only effects (hospital EHR systems, bank back-office systems). CONFIRMED

## Timeline
- Last confirmed normal state: prior to 04:09 UTC, July 19, 2024. CONFIRMED
- Faulty Channel File 291 (timestamp 2024-07-19 04:09 UTC) deployed to Falcon Sensor. CONFIRMED (CrowdStrike RCA, TechTarget)
- Windows systems running the sensor began crashing into Blue Screen of Death / boot loops shortly after. CONFIRMED
- 05:27 UTC: CrowdStrike identifies the issue and reverts the change. Systems booted after this point were not newly affected. CONFIRMED (Bitsight, NPR — 1:27 a.m. ET cutoff)
- Fix identified and deployed within 79 minutes of the initial deployment, per CrowdStrike's own account. CONFIRMED (TechTarget)
- 11:30 a.m. EDT: CISA issues initial public alert confirming the cause is a CrowdStrike content update, not malicious activity. CONFIRMED (CISA)
- Mid-morning: United, Delta, and American Airlines issue a ground stop (grounded aircraft, in-flight aircraft allowed to land). CONFIRMED
- ~10:30 a.m. ET: AP reports ~1,500 US flight cancellations already recorded. CONFIRMED
- Throughout the day: hospitals, broadcasters, banks, and retailers globally report BSOD-related disruption. CONFIRMED
- July 19–22: CrowdStrike and Microsoft jointly issue remediation guidance; most affected organizations recover within days. CONFIRMED
- July 20: Microsoft releases a USB-based recovery tool for systems that can't self-recover. CONFIRMED
- Delta's disruption continues for five full days (through July 24–25), far longer than other airlines. CONFIRMED
- Aug 7, 2024: CrowdStrike publishes full Root Cause Analysis. CONFIRMED
- Sept 24, 2024: CrowdStrike SVP Adam Meyers apologizes to Congress at a House Homeland Security subcommittee hearing. CONFIRMED
- Oct 25, 2024: Delta files suit against CrowdStrike (~$500M+ sought). CONFIRMED
- May 2025: Georgia judge allows Delta's gross negligence and computer trespass claims to proceed, dismisses other claims. CONFIRMED
- Current status: resolved as an operational incident; litigation between Delta and CrowdStrike remains open as of the most recent reporting. CONFIRMED

## People / Actors
- George Kurtz, CrowdStrike President & CEO: posted the first public acknowledgment on X; said Mac/Linux unaffected, not a cyberattack; later told NBC's TODAY show recovery "could be some time" for some systems. CONFIRMED, on-record quotes.
- Adam Meyers, CrowdStrike SVP Counter Adversary Operations: apologized before Congress, Sept 24, 2024. CONFIRMED.
- CISA: issued public alerts starting 11:30 a.m. EDT July 19, continuing through Aug 6. CONFIRMED.
- Delta Air Lines: hardest-hit major carrier; 7,000 cancellations over 5 days; later sued CrowdStrike. CONFIRMED.
- Mass General Brigham, Cleveland Clinic, Cincinnati Children's, Mount Sinai, Nationwide Children's, Ohio State Wexner, and 6+ other US hospital systems: canceled non-urgent procedures. CONFIRMED (institutional statements only — no named private patients used in this piece per constraints).
- Sky News (UK), BBC's CBBC, Australian broadcasters (ABC, SBS, Network Ten, Sky News Australia), NBC affiliate KSHB-TV, ESPN: broadcast interruptions. CONFIRMED.
- Mercedes-AMG Petronas F1 team (CrowdStrike sponsorship client): had to manually fix every team computer during the Hungarian Grand Prix weekend. CONFIRMED.
- Southwest Airlines: entirely unaffected; does not use CrowdStrike Falcon. CONFIRMED (Southwest declined to confirm whether this was because of outdated software, per Wikipedia's sourcing).

## Physical / Digital Evidence (Artifacts)
- Channel File 291 (C-00000291*.sys), timestamp 2024-07-19 04:09 UTC — the faulty file. CONFIRMED
- George Kurtz's initial X post acknowledging the defect. CONFIRMED, public, archived.
- CrowdStrike's Preliminary Post Incident Review (July 24, 2024) and full Root Cause Analysis (Aug 7, 2024). CONFIRMED, public documents.
- CISA alert bulletin, initial and updated versions. CONFIRMED, public.
- Delta's legal complaint (filed Oct 25, 2024, Fulton County Superior Court, Georgia). CONFIRMED, public record.

## Time-Sensitive Factors (Clocks)
- Technical: window during which systems booting fresh would avoid the bug (anything after 05:27 UTC / 1:27 a.m. ET was safe). CONFIRMED.
- Operational: manual remediation requirement — each affected machine needed physical or remote Safe Mode access to delete one file, which does not scale automatically. CONFIRMED.
- Media cycle: the story dominated news cycles for days, intensifying scrutiny of Delta's slower recovery relative to peers. CONFIRMED.
- Legal: Delta's litigation clock — three months from incident to filing suit. CONFIRMED.
- Narrative: CrowdStrike's public position ("not a security incident," "fixed within 79 minutes") under pressure from the scale of real-world disruption still unfolding for days after the technical fix. CONFIRMED as a live tension in contemporaneous reporting.

## Known vs. Unknown
- Confirmed: root technical cause (mismatch between 21 defined input fields and 20 provided by sensor code; missing bounds check in the Content Interpreter; logic error in the Content Validator). Source: CrowdStrike RCA, TechTarget.
- Confirmed absence: this was not a cyberattack, not malicious. Stated repeatedly by CrowdStrike, CISA, and Microsoft, cross-referenced.
- Disputed: responsibility for Delta's disproportionately long recovery. Delta blames CrowdStrike's alleged shortcuts and an "unauthorized door" into the Windows kernel; CrowdStrike blames Delta's own outdated IT infrastructure and slow modernization. Both positions are on the record and contested — flagged as DISPUTED, not resolved in this piece.
- Speculation (labeled, not endorsed): early social-media speculation that the outage was a cyberattack, quickly ruled out by CISA and CrowdStrike within hours.

## Detail Harvesting (vivid, verified, sourced)

- "Blue Screen of Death" appearing on cash registers in grocery stores in Sydney and Brisbane, Australia (Source: Al Jazeera, photo captions via Reuters/AAP)
- Channel File 291, filename format C-00000291*.sys (Source: CrowdStrike RCA, TechTarget)
- Deployment timestamp 04:09 UTC; revert timestamp 05:27 UTC (Source: Bitsight, NPR)
- Fix identified and deployed in 79 minutes (Source: TechTarget)
- Edinburgh Airport's departure boards froze; Gatwick's barcode scanners stopped working, tickets checked by hand (Source: Wikipedia, sourced to contemporaneous UK reporting)
- Sky News UK off air, later returning "without full capabilities" per chairman David Rhodes's own statement on X (Source: NPR)
- ESPN's SportsCenter replaced by an ESPN Radio simulcast; later Get Up! and First Take aired "without on-air graphics or B-roll" (Source: Wikipedia)
- MeTV Toons channel off air for five and a half hours (Source: Wikipedia)
- Mercedes-AMG Petronas F1 team — sponsored by CrowdStrike — had to manually fix every one of its own computers during the Hungarian Grand Prix weekend (Source: Wikipedia)
- Southwest Airlines entirely unaffected, the only major US carrier untouched (Source: Wikipedia)
- Hartsfield-Jackson Atlanta's North Terminal: "crowd control ... got testy early July 19" per contemporaneous AJC photo caption; unclaimed bags piled in the South terminal baggage area for days (Source: Atlanta Journal-Constitution)
- Delta set up an internal "Baggage Command Center" in Atlanta specifically to reunite passengers with displaced luggage (Source: FOX 5 Atlanta)
- Phoenix, AZ police department's computerized 911 dispatch was down; calls were answered but caller information logged by hand (Source: Congress.gov / CRS)
- Portland, OR's Bureau of Emergency Communication computer-aided dispatch (CAD) system was down; same manual-answer workaround (Source: Congress.gov / CRS)
- CrowdStrike's own description of its footprint: software on systems at over half of the Fortune 500, 8 in 10 top financial services firms, 6 in 10 top healthcare providers (Source: company website, cited by Healthcare Dive)
