<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class UserEdit extends FormRequest
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
    public function rules()
    {
        $id = Auth::user()->id;
        return [
            'nickname' => 'bail|required|between:4,12|unique:cmf_userinfos,nickname,'.$id,
            'headimage'=>'bail|required',
            'phone'=>'bail|required|numeric|regex:/^1[34578][0-9]{9}$/|unique:cmf_userinfos,phone,'.$id,
            'province'=>'bail|required',
            'city'=>'bail|required',
            'birthday' => 'bail|required',
            'signature'=>'bail|required|between:5,50',
        ];
    }

    /**
     * 获取已定义的验证规则的错误消息。
     * @author yy
     * @Date 2018/8/11
     */
    public function messages(){
        return [
            "phone.regex" => "电话格式不正确",
        ];

    }


}
