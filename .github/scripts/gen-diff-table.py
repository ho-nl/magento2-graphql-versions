#!/usr/bin/env python3
"""Regenerate the "Schema diffs" table in README.md.

The table is the single source of truth for how versions compare, and it is too
intricate to hand-edit safely. To add a version: add a row to `rows` below (keep
it in table order), then run `python3 .github/scripts/gen-diff-table.py` and
commit the README change.

Each row is a tuple:
    (magento, m_prev, core, c_prev, mageos, mo_prev, cross_core)

  magento    Magento tag shown in col 1 (None for a Mage-OS-only continuation row)
  m_prev     previous Magento tag for the col-1 down-arrow (None = no arrow)
  core       core-* tag in col 3, or "UNBUILDABLE", or None
  c_prev     previous core-* tag for the col-3 down-arrow
  mageos     mage-os-* tag in col 5 (None if the row has no Mage-OS release)
  mo_prev    previous mage-os-* tag (or the Magento fork base) for its down-arrow
  cross_core core-* tag used as the → source when `core` is empty (continuation rows)

Arrows: ↓ = vs previous release in the same column; ← = core vs bundled Magento
(same row); → = core vs the Mage-OS release of the same row. All links are
direct two-dot (`a..b`) diffs. See the Notes under the table for the pinning of
Mage-OS releases to their Magento base (per the Mage-OS compatibility matrix).
"""
import os

B = "https://github.com/ho-nl/magento2-graphql-versions/compare/"

def link(sym, a, b):
    return f"[{sym}]({B}{a}..{b})"

# magento, m_prev, core, c_prev, mageos, mo_prev, cross_core
rows = [
    ("2.3.0", None, "core-2.3.0", None, None, None, None),
    ("2.3.1", "2.3.0", "core-2.3.1", "core-2.3.0", None, None, None),
    ("2.3.2", "2.3.1", "UNBUILDABLE", None, None, None, None),
    ("2.3.3", "2.3.2", "core-2.3.3", "core-2.3.1", None, None, None),
    ("2.3.4", "2.3.3", "core-2.3.4", "core-2.3.3", None, None, None),
    ("2.3.5", "2.3.4", "core-2.3.5", "core-2.3.4", None, None, None),
    ("2.4.0", "2.3.5", "core-2.4.0", "core-2.3.5", None, None, None),
    ("2.4.1", "2.4.0", "core-2.4.1", "core-2.4.0", None, None, None),
    ("2.4.2", "2.4.1", "core-2.4.2", "core-2.4.1", None, None, None),
    ("2.4.3", "2.4.2", "core-2.4.3", "core-2.4.2", None, None, None),
    ("2.4.4", "2.4.3", "core-2.4.4", "core-2.4.3", None, None, None),
    ("2.4.5", "2.4.4", "core-2.4.5", "core-2.4.4", None, None, None),
    ("2.4.6", "2.4.5", "core-2.4.6", "core-2.4.5", "mage-os-1.0.0", "2.4.6", None),
    ("2.4.6-p8", "2.4.6", "core-2.4.6-p8", "core-2.4.6", None, None, None),
    ("2.4.6-p9", "2.4.6-p8", "core-2.4.6-p9", "core-2.4.6-p8", None, None, None),
    ("2.4.6-p15", "2.4.6-p9", "core-2.4.6-p15", "core-2.4.6-p9", None, None, None),
    ("2.4.7", "2.4.6", "core-2.4.7", "core-2.4.6", None, None, None),
    ("2.4.8", "2.4.7", "core-2.4.8", "core-2.4.7", "mage-os-1.1.0", "mage-os-1.0.0", None),
    ("2.4.8-p1", "2.4.8", "core-2.4.8-p1", "core-2.4.8", "mage-os-1.2.0", "mage-os-1.1.0", None),
    ("2.4.8-p2", "2.4.8-p1", "core-2.4.8-p2", "core-2.4.8-p1", "mage-os-1.3.0", "mage-os-1.2.0", None),
    ("2.4.8-p3", "2.4.8-p2", "core-2.4.8-p3", "core-2.4.8-p2", "mage-os-2.0.0", "mage-os-1.3.0", None),
    (None, None, None, None, "mage-os-2.1.0", "mage-os-2.0.0", "core-2.4.8-p3"),
    ("2.4.8-p4", "2.4.8-p3", "core-2.4.8-p4", "core-2.4.8-p3", "mage-os-2.2.0", "mage-os-2.1.0", None),
    ("2.4.8-p5", "2.4.8-p4", "core-2.4.8-p5", "core-2.4.8-p4", "mage-os-2.3.0", "mage-os-2.2.0", None),
    ("2.4.9", "2.4.8", "core-2.4.9", "core-2.4.8", "mage-os-3.0.0", "mage-os-2.3.0", None),
    (None, None, None, None, "mage-os-3.1.0", "mage-os-3.0.0", "core-2.4.9"),
    (None, None, None, None, "mage-os-3.2.0", "mage-os-3.1.0", "core-2.4.9"),
    (None, None, None, None, "mage-os-3.3.0", "mage-os-3.2.0", "core-2.4.9"),
    (None, None, None, None, "mage-os-3.4.0", "mage-os-3.3.0", "core-2.4.9"),
]

out = ["| Magento | ← | Magento core | → | Mage-OS |",
       "|---------|:-:|--------------|:-:|---------|"]
for m, mp, c, cp, mo, mop, cross in rows:
    mc = m + (" " + link("↓", mp, m) if mp else "") if m else ""
    left = link("←", c, m) if (m and c and c != "UNBUILDABLE") else ""
    if c == "UNBUILDABLE":
        cc = "*(unbuildable)*"
    elif c:
        cc = c + (" " + link("↓", cp, c) if cp else "")
    else:
        cc = ""
    src = c if (c and c != "UNBUILDABLE") else cross
    right = link("→", src, mo) if (src and mo) else ""
    moc = mo + " " + link("↓", mop, mo) if mo else ""
    out.append(f"| {mc} | {left} | {cc} | {right} | {moc} |")
table = "\n".join(out)

readme = os.path.join(os.path.dirname(__file__), "..", "..", "README.md")
src = open(readme).read()
start = src.index("| Magento | ")
end = src.index("\n\nNotes:")
open(readme, "w").write(src[:start] + table + src[end:])
print(f"regenerated {len(rows)}-row table")
