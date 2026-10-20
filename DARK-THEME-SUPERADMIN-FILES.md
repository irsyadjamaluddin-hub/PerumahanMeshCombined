# Super Admin pages: new dark theme + EN/BM (applied 15 Oct 2026)

Dark mode in the Home page theme (purple/gold) and the English/Malay switch, applied to the Super Admin pages
marked NONE in the list. Every change is inside `NEWLY ADDED` / `ORI CODE` markers. Light mode is unchanged.
Preview: https://claude.ai/artifact/S5GEFqSPEn5iA9wEpEvb6V

## Shared files (upload these too)

| File | What changed |
|---|---|
| `public/css/mesh-dark.css` | New block at the end: gold table headings and detail labels, `.mesh-gold-title`, violet form outlines, red bin buttons, `.table-achiev` table, Tailwind parts (announcement boxes, SSM "Master Search") |
| `public/js/mesh-lang.js` | New words for these pages (both directions), "Position ID" / "Ref. No." group, "3 Days/s" -> "3 Hari" rule |

## Page files (each wrapped in `<div class="mesh-home-theme">`)

| Service | Page | File |
|---|---|---|
| My SSM | Activate SSM Account | `resources/views/ssms/indexall.blade.php` |
| My SSM | SSM Request Admin | `resources/views/ssmrequests/indexall.blade.php` |
| My SSM | SSM Application | `resources/views/ssmrequests/indexpermohonan.blade.php` |
| Information | Cuti | `resources/views/cutis/index.blade.php` |
| Information | Memangku | `resources/views/actings/index.blade.php` |
| Information | Bersara | `resources/views/bersaras/index.blade.php` |
| Information | Baki Cuti | `resources/views/bakicuti/indexadmin.blade.php` |
| MNS | MNS | `resources/views/onlinenotification/index.blade.php` |
| MNS | Eye icon | `resources/views/onlinenotification/adminview.blade.php` |
| Q&A | Q&A | `resources/views/soalantaklimat/indexadmin.blade.php` |
| Q&A | Eye icon | `resources/views/soalantaklimat/showadmin.blade.php` |
| MEA | Edit icon | `resources/views/moeevent/editadmin.blade.php` |
| MEA | Approved participant | `resources/views/moeevent/participant.blade.php` |
| MEA | Dashboard | `resources/views/moeevent/chart.blade.php` |
| MAS | Eye icon | `resources/views/slipkedatangan/showslip.blade.php` |
| MAS | Add IC No. | `resources/views/slipkedatangan/accessske.blade.php` |
| MAS | + (new perkara) * | `resources/views/slipkedatangan/createevent.blade.php` |
| MAS | Shared with me | `resources/views/slipkedatangan/sharedperkara.blade.php` |
| DRF | DRF | `resources/views/devopsrequest/indexadmin.blade.php` |
| DRF | Share people icon | `resources/views/devopsrequest/admin-email.blade.php` |
| DSS | DSS | `resources/views/support_center/index.blade.php` |
| DSS | Edit * | `resources/views/support_center/edit.blade.php` |
| DSS | Manage admin emails | `resources/views/support_center/dsdemail.blade.php` |
| MOE Enquiries | Main page (message box) | `resources/views/soalanbiskita/indexadmin.blade.php` |
| MOE Enquiries | Edit Perkara | `resources/views/soalanbiskita/editperkara.blade.php` |
| MOE Enquiries | Edit Perkara: edit * | `resources/views/soalanbiskita/editperkaraic.blade.php` |
| MOE Enquiries | Edit Jabatan | `resources/views/soalanbiskita/jabatanlist.blade.php` |
| MOE Enquiries | Edit Jabatan: edit * | `resources/views/soalanbiskita/editdept.blade.php` |
| MB | Banner * | `resources/views/banner/index.blade.php` |
| MA | Announcements | `resources/views/announcement/announcementadmin.blade.php` |
| MA | Edit | `resources/views/announcement/announcementadmin-edit.blade.php` |
| MN | News | `resources/views/news/newsadmin.blade.php` |

\* also has a small page tweak:

- `createevent`: "Perkara Baru" centred
- `support_center/edit`: "Butiran Permohonan Sokongan" centred and gold
- `editperkaraic`: wider label columns (`col-lg-2`) and subject box (`col-lg-6`)
- `editdept`: "Edit Senarai Jabatan" centred and gold
- `banner/index`: "Masukkan Paparan Iklan" centred and gold
