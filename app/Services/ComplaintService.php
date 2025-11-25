<?php

namespace App\Services;

class ComplaintService
{
    public function createComplaint($request)
    {
        //  تسجيل شكوى جديدة
    }

    public function getComplaintById($id)
    {
        //  جلب تفاصيل شكوى محددة
    }

    public function getUserComplaints($userId)
    {
        //  جلب جميع شكاوى المستخدم
    }

    public function addAttachment($request, $complaintId)
    {
        //  رفع الملفات وربطها بالشكوى
    }

    public function getComplaintTracking($complaintId)
    {
        //  جلب التحديثات والحالة الزمنية للشكوى
    }
}
