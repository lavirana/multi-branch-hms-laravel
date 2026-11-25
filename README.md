Multi-branch Hospital Management System built with Laravel REST API & React. Includes RBAC, slot booking with DB locks, lab reports & billing.

#Role AND What they can do

Super Admin -> Everything, all branches
Branch Admin -> Manage one branch: doctors, staff, appointments, billing
Doctor -> See own appointments and patients, add medical notes, request lab tests
Receptionist -> Register patients, book and cancel appointments, create bills
Lab Technician -> See assigned lab tests, upload reports
Patient -> See own profile, appointments, reports, invoices

#Key relationships
• Branch has many users, appointments and invoices (through branch_id).
• Doctor belongs to Specialization and User, and embeds many branches (with fee and availability).
• Patient embeds many medical histories, and has many appointments, lab requests and invoices.
• Appointment belongs to Patient, Doctor and Branch, and has one Visit.
• LabRequest embeds many items, and each item can hold a report.
• Invoice embeds many items and payments. Each item points to the appointment or lab item it bills.
• Add an index on every \_id reference you filter by (doctor_id, patient_id, branch_id).

#Important statuses (Enums)
• Appointment: pending, confirmed, completed, cancelled, no_show.
• Lab request: requested, assigned, in_progress, completed.
• Invoice: unpaid, partial, paid, cancelled.
