<?php

namespace App\Services;

class AdminComplaintService
{
    public function getAllComplaints()
    {
        //  جلب جميع الشكاوى لموظفي الجهة الحكومية
    }

    public function updateStatus($request, $complaintId)
    {
        //  تغيير حالة الشكوى (جديدة - قيد المعالجة - مغلقة - مرفوضة)
    }

    public function addNote($request, $complaintId)
    {
        //  إضافة ملاحظات الموظف على الشكوى
    }
}
