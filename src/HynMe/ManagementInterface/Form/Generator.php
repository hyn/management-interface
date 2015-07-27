<?php namespace HynMe\ManagementInterface\Form;

use HynMe\Framework\Validators\AbstractValidator;
use HynMe\Framework\Models\AbstractModel;

class Generator
{

    /**
     * @var AbstractModel
     */
    protected $model;

    /**
     * @var AbstractValidator
     */
    protected $validator;

    /**
     * @var \Illuminate\Http\Response
     */
    protected $redirect;

    /**
     * @var array
     */
    protected $params;

    public function __construct(AbstractModel $model, AbstractValidator $validator = null, $params = [])
    {
        $this->model = $model;
        $this->validator = $validator;
        $this->redirect = array_get($params, 'redirect');
        $this->params = $params;
    }

    /**
     * Opens form
     * @param array $attributes
     * @return \Illuminate\View\View
     */
    public function open($attributes = [])
    {
        return $this->view('open', $attributes);
    }

    /**
     * Closes form
     * @return \Illuminate\View\View
     */
    public function close()
    {
        return $this->view('close');
    }

    /**
     * Text
     * @param       $name
     * @param       $label
     * @param array $params
     * @return \Illuminate\View\View
     */
    public function text($name, $label, $params = [])
    {
        return $this->view('text', array_merge(compact('name', 'label'), $params));
    }

    /**
     * Textarea
     * @param $name
     * @param array $params
     * @return \Illuminate\View\View
     */
    public function textarea($name, $label, $params = [])
    {
        return $this->view('textarea', array_merge(compact('name', 'label'), $params));
    }

    /**
     * Cancel button
     * @return \Illuminate\View\View
     */
    public function cancel()
    {
        return $this->view('cancel', ['redirect' => 'javascript: window.history.back();']);
    }

    /**
     * Submit button
     * @return \Illuminate\View\View
     */
    public function submit()
    {
        return $this->view('submit');
    }

    public function buttons()
    {
        return $this->view('buttons', [
            'cancel' => $this->cancel(),
            'submit' => $this->submit()
        ]);
    }

    /**
     * @param       $name
     * @param       $label
     * @param array $params
     * @return \Illuminate\View\View
     */
    public function checkbox($name, $label, $params= [])
    {
        return $this->view('checkbox', array_merge(compact('name', 'label'), $params));
    }

    /**
     * Toggle option
     * @param       $name
     * @param       $label
     * @param array $params
     * @return \Illuminate\View\View
     */
    public function toggle($name, $label, $params= [])
    {
        return $this->view('toggle', array_merge(compact('name', 'label'), $params));
    }

    /**
     * @param       $name
     * @param       $label
     * @param array $params
     * @return \Illuminate\View\View
     */
    public function ajaxSelect($name, $label, $params = [])
    {
        return $this->view('ajaxSelect', array_merge(compact('name', 'label'), $params));
    }

    /**
     * @param       $field
     * @param array $params
     * @return \Illuminate\View\View
     */
    protected function view($field, $params = [])
    {
        $params = array_merge([
            'model' => $this->model
        ], $this->params, $params);

        return view('management-interface::template.forms.' . $field, $params)->render();
    }

    public function processRequest()
    {
        $processed = null;

        if($this->validator)
        {
            $processed = $this->validator->catchFormRequest($this->model, $this->redirect);
        }

        return $processed ?: false;
    }

}