# CrowdStrike Falcon Outage / X Thread
### Format: formats/x-thread.md | POV: on-call site reliability engineer (composite, invented) | Status: resolved/historical

---

## POST 1: FRAME

`[MY SUPER BASED OPINION]`

It is just after midnight, Eastern time, July 19, 2024. You are on call.

The dashboard sits on your second monitor the way it always does, mostly green, a few yellow tickets from the evening shift. Nothing that needs you awake.

Then the alert count starts climbing.

Not one machine. Not ten. The number keeps refreshing upward, and every entry says the same thing: blue screen, reboot, blue screen again.

You do not know yet what is causing it.

---

## POST 2: SCENE 1.1 / THE FIRST ALERTS

`[MY SUPER BASED OPINION]`

The pattern repeats faster than you can read it. Crash, restart, crash again. Machines that were fine an hour ago are stuck in a loop that does not resolve on its own.

At first this reads like a bad patch. Bad patches happen. You have seen bad patches.

But bad patches do not usually hit this many machines at once, with this little variation between them.

You open the fleet view to find out how far it actually goes.

---

## POST 3: SCENE 1.2 / THE FLEET CHECK

`[MY SUPER BASED OPINION]`

The number is bigger than you expected. A real share of your Windows fleet is down, all at the same time, all in the same loop.

You look for what they have in common. It does not take long to find it. Every affected machine is running the same security sensor.

That could be the cause. It could also be a coincidence.

You do not know which yet. You do not know if anyone outside your own building is seeing this too.

---

## POST 4: SCENE 1.3 / THE FIRST OUTSIDE SIGNAL

`[MY SUPER BASED OPINION]`

You check your phone, mostly out of habit. Social media is already collecting scattered, unconfirmed reports that sound like your machines. Different companies, different countries, same blue screen.

No one official has said anything yet.

Is this an attack. Nobody in the group chat says it first. Nobody has ruled it out. Nobody has confirmed it either.

You keep working the queue in front of you, because waiting for an answer is not a plan.

---

## POST 5: SCENE 2.1 / THE VENDOR POSTS

`[MY SUPER BASED OPINION]`

A post from the CEO of the security company starts circulating. He says a single faulty content update caused it. He says Mac and Linux systems are untouched. He says it plainly: this is not an attack.

Knowing it is not an attack changes nothing on your own screen.

Knowing it is not an attack does not un-crash a single one of your machines. The fix he describes is already live on his end. It has no way to reach yours.

You are told the cause. You are not told how long your own recovery will take.

---

## POST 6: SCENE 2.2 / THE OFFICIAL WORD

`[MY SUPER BASED OPINION]`

By late morning, the federal cybersecurity agency confirms the same account publicly. Same cause, same conclusion. Not malicious.

The question that opened the night is closed now, for good.

It does not change your queue. It does not tell you how many machines, across how many other buildings like yours, are stuck exactly where yours are.

---

## POST 7: SCENE 2.3 / THE MANUAL QUEUE

`[MY SUPER BASED OPINION]`

Here is the part the public statements do not spell out. The fix stops new damage. It does nothing for a machine that already crashed.

Each one of those has to be walked back by hand. Boot into Safe Mode. Find one file. Delete it. Reboot. Confirm. Move to the next machine.

There is no script that does this for you at scale. Someone has to touch each box.

You start counting how many hands you have and how many boxes are waiting.

---

## POST 8: SCENE 3.1 / THE GROUND STOP

`[MY SUPER BASED OPINION]`

Somewhere around mid-morning, the news changes shape. Three of the largest US airlines have issued a ground stop. Planes already in the air can land. Nothing new is taking off.

By the time you read the number, it is already stale. Fifteen hundred flights canceled and climbing. A terminal in Atlanta is loud in a way terminals are not supposed to be loud.

One airline, further down in the same article, is untouched. Nobody explains why yet. Maybe it is luck. Maybe it is something about their systems being old enough that none of this reached them.

You do not know which. Neither, it seems, does the reporter.

---

## POST 9: SCENE 3.2 / THE HOSPITALS

`[MY SUPER BASED OPINION]`

More statements come in through the same feed. Hospital systems, one after another, announcing the same decision. Non-urgent surgeries postponed. Procedures rescheduled. Emergency departments staying open regardless.

None of it is about you. All of it is the same problem you are looking at, just wearing different clothes.

You do not know what any of this costs anyone on the other end of those cancellations. That is not information you have access to, and it is not information this queue is going to give you.

---

## POST 10: SCENE 3.3 / DEAD AIR

`[MY SUPER BASED OPINION]`

A television in the break room is running a national morning show. It cuts, oddly, to a backup segment with no graphics behind the anchor.

A news channel across the ocean is off the air entirely. It comes back a few hours later, running on less than everything it started the day with.

By now the event is no longer a technical incident happening somewhere else. It is the condition of the day, in every window you check, everywhere at once.

---

## POST 11: SCENE 3.4 / WHAT'S LEFT RUNNING

`[MY SUPER BASED OPINION]`

Your shift is close to over. The dashboard is mostly green again. Not all the way.

A handful of machines are still sitting on the same blue screen they started the night on, waiting for hands that have not reached them yet. You know exactly what is wrong with them now. Knowing has not fixed them.

Somewhere, that one airline is apparently still running an unbroken schedule, for reasons nobody has nailed down. Somewhere else, people are still finding out their flight is not one of the lucky ones.

You log the handoff notes for the next shift. The queue is smaller than it was. It is not zero.

---

## FINAL POST: BOARD STATE

`[MY SUPER BASED OPINION]`

**Subject status:** The faulty update has been identified and reverted at the source. No new machines are being affected as of the revert.

**Location status:** Airports, hospitals, broadcasters, and retailers worldwide reported disruption through the day. Most report recovery within one to two days. At least one major airline's recovery runs considerably longer than its peers, for reasons still being worked out between the airline and the vendor.

**Persons of interest:** None. This was confirmed early and repeatedly as a non-malicious technical failure, not an attack.

**Evidence status:** The vendor's own internal review of the root cause is pending at the close of this thread. It will be published in the following weeks.

**Communications:** The vendor's CEO and the federal cybersecurity agency have both spoken publicly. Both accounts agree on cause and intent. Neither addresses how long full recovery will take for any specific organization.

**Narrative status:** The vendor's public framing centers on how quickly the underlying fix was deployed. The framing does not fully account for how long manual recovery took at the edges, for machines and organizations already affected before the fix landed.

Event status: resolved, technically, at the source. Still active, operationally, in an unknown number of queues like yours.
Case status: open. The gap between the vendor's fastest account of itself and the slowest recoveries on the ground has not been settled.
Next move: unknown.
