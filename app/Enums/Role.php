<?php

namespace App\Enums;

enum Role: string
{
    case SuperAdmin = 'super_admin';
    case BranchAdmin = 'branch_admin';
    case Doctor = 'doctor';
    case Receptionist = 'receptionist';
    case LabTechnician = 'lab_technician';
    case Patient = 'patient';
}