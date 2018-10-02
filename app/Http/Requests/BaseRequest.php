<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\HappyLocate\Constants\Corporate\Service;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [];
    }

    /**
     * The allowed mime types for image uploads.
     * Generates the 'mimes' rule string.
     *
     * @return string
     */
    protected function allowedImages()
    {
        $mimeTypes = $this->config('uploads.image.allowed_mime', ['jpeg', 'png']);

        return 'file|mimes:' . implode(',', $mimeTypes);
    }

    /**
     * The allowed mime types for corporate file uploads.
     * Generates the 'mimes' rule string.
     *
     * @return string
     */
    protected function allowedFiles()
    {
        $mimeTypes = $this->config('corporate.upload.file.allowed_mime', ['jpeg', 'png', 'bmp', 'pdf', 'xls', 'xlsx']);

        return 'file|mimes:' . implode(',', $mimeTypes);
    }

    /**
     * The allowed mime types for employee file uploads.
     * Generates the 'mimes' rule string.
     *
     * @return string
     */
    protected function allowedEmployeeUploadFiles()
    {
        $mimeTypes = $this->config('corporate.upload.employee.allowed_mime', [
            'application/vnd.ms-excel', // Excel 2003
            'application/vnd.ms-office', // Open office
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // Excel 2007+
        ]);

        return 'file|mimetypes:' . implode(',', $mimeTypes);
    }

    /**
     * User profile picture file upload rule.
     *
     * @return string
     */
    protected function userProfilePictureRule()
    {
        $minResolution = $this->config('user.upload.profile-picture.image.min_resolution', 100);

        $maxFileSizeKb = $this->config('user.upload.profile-picture.image.max_file_size_kb', 1000);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * User support ticket attachment upload rule.
     *
     * @return string
     */
    protected function userSupportTicketAttachmentRule()
    {
        $maxFileSizeKb = $this->config('user.upload.ticket.image.max_file_size_kb', 2000);

        return $this->allowedImages() . "|max:{$maxFileSizeKb}";
    }

    /**
     * Hotel image upload rule.
     *
     * @return string
     */
    protected function hotelImageRule()
    {
        $maxFileSizeKb = $this->config('hotel.upload.gallery.image.max_file_size_kb', 5000);
        $minResolution = $this->config('hotel.upload.gallery.image.min_resolution', 200);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Hotel Reservation Exception image upload rule.
     *
     * @return string
     */
    protected function reservationExceptionImageRule()
    {
        $maxFileSizeKb = $this->config('hotel.upload.reservation_exception.image.max_file_size_kb', 5000);
        $minResolution = $this->config('hotel.upload.reservation_exception.image.min_resolution', 200);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Vendor company logo file upload rule.
     *
     * @return string
     */
    protected function vendorCompanyLogoRule()
    {
        $minResolution = $this->config('pam.upload.logo.image.min_resolution', 150);

        $maxFileSizeKb = $this->config('pam.upload.logo.image.max_file_size_kb', 2000);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Corporate company logo file upload rule.
     *
     * @return string
     */
    protected function corporateCompanyLogoRule()
    {
        $minResolution = $this->config('corporate.upload.logo.image.min_resolution', 150);

        $maxFileSizeKb = $this->config('corporate.upload.logo.image.max_file_size_kb', 2000);

        return $this->allowedImages() . "|dimensions:min_width={$minResolution},min_height={$minResolution}" . "|max:{$maxFileSizeKb}";
    }

    /**
     * Vendor proof file upload rule.
     *
     * @return string
     */
    protected function vendorProofImageRule()
    {
        $maxFileSizeKb = $this->config('pam.upload.proof.image.max_file_size_kb', 5000);

        return $this->allowedImages() . "|max:{$maxFileSizeKb}";
    }

    /**
     * Corporate file upload rule.
     *
     * @return string
     */
    protected function corporateFileUploadRule()
    {
        $maxFileSizeKb = $this->config('corporate.upload.file.max_file_size_kb', 5000);

        return $this->allowedFiles() . "|max:{$maxFileSizeKb}";
    }

    /**
     * Corporate employee upload file rule.
     *
     * @return string
     */
    protected function corporateEmployeeUploadRule()
    {
        $maxFileSizeKb = $this->config('corporate.upload.employee.max_file_size_kb', 5000);

        return $this->allowedEmployeeUploadFiles() . "|max:{$maxFileSizeKb}";
    }

    /**
     * Minimum relocation date rule.
     *
     * @return string
     */
    protected function minimumRelocationDateRule()
    {
        $minDaysDiff = $this->config('pam.relocation.date_min_days_diff', 1);

        return "after_or_equal:+ {$minDaysDiff} days";
    }

    /**
     * Get Allowed Hotel types.
     *
     * @return string
     */
    protected function allowedTravelRequestTypes()
    {
        return 'in:'. implode(',', [Service::HOTEL, Service::FLIGHT]);
    }

    /**
     * Returns the rule for allowed name titles.
     *
     * @return string
     */
    protected function allowedNameTitles()
    {
        $allowedTitles = ['Mr.', 'Ms.', 'Mrs.', 'Mstr.'];
        return 'in:' . implode(',', $allowedTitles);
    }

    /**
     * Get GSTIN Rule.
     *
     * @param bool $required
     * @return string
     */
    protected function GSTINRule(bool $required = true)
    {
        return ($required ? 'required|' : 'sometimes|') . 'string|max:15';
    }

    /**
     * Get PAN Card Rule.
     *
     * @param bool $required
     * @return string
     */
    protected function PANCardRule(bool $required = true)
    {
        return ($required ? 'required|' : 'sometimes|') . 'string|max:10';
    }

    /**
     * Get City Rule.
     *
     * @param bool $required
     * @return string
     */
    protected function cityRule(bool $required = true)
    {
        return ($required ? 'required|' : 'sometimes|') . 'uuid|exists:cities,id';
    }

    /**
     * Get email rule.
     *
     * @param bool $required
     * @return string
     */
    protected function emailRule(bool $required = true)
    {
        return ($required ? 'required|' : 'sometimes|') . 'email|max:150';
    }

    /**
     * Get OTP Rule.
     *
     * @param bool $required
     * @return string
     */
    protected function otpRule(bool $required = true)
    {
        return ($required ? 'required|' : 'sometimes|') . 'otp';
    }

    /**
     * Get the config value.
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    protected function config($key, $default = null)
    {
        return data_get(config('happylocate'), $key, $default);
    }
}
