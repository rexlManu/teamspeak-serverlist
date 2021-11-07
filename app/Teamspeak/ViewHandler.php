<?php


namespace App\Teamspeak;


class ViewHandler
{

    private $data;
    private $view;

    public function __construct($data)
    {
        $this->data = $data;
        $this->view = '';

        $this->view .= '<li class="dd-item" data-id="8"><div class="dd-handle text-center" style="border: unset !important;background: unset !important; margin: unset !important;">' . $data[0]['name'] . '</div></li>';
        foreach ($this->getLayersByIdent($data[0]['ident'], $data) as $layer) {
            $this->view .= $this->addStyles($layer);
            $this->loadParent($layer, $data);
            $this->view .= '</li>';
        }
    }

    function getLayersByIdent($ident, $data)
    {
        return array_filter($data, function ($sub) use ($ident, $data) {
            return $sub['parent'] == $ident;
        });
    }

    function loadParent($layer, $data)
    {
        $layers = $this->getLayersByIdent($layer['ident'], $data);
        if (empty($layers)) return;
        $this->view .= '<ol class="dd-list">';
        foreach ($layers as $layer) {
            $this->view .= $this->addStyles($layer);
            $this->loadParent($layer, $data);
            $this->view .= '</li>';
        }
        $this->view .= '</ol>';
    }

    function addStyles($layer)
    {
        switch (array_key_exists('spacer', $layer['props']) ? $layer['props']['spacer'] : 'MISSING') {
            case 'customcenter':
                return '<li class="dd-item"><div class="dd-handle text-center" style="border: unset !important;background: unset !important; margin: unset !important;"> ' . $layer['name'] . ' </div>';
            case 'solidline':
                return '<li class="dd-item"><div class="dd-handle text-center" style="border: unset !important;background: unset !important; margin: unset !important;">' . str_repeat($layer['name'], 10) . '</div>';
            default:
                //return '<li class="dd-item"><div class="dd-handle" style="border: unset !important;background: unset !important; margin: unset !important;"> ' . $this->getIcon($layer['image']) . ' ' . $layer['name'] . ' </div>';
        }
        if ($layer['class'] == 'client'){
            //dd($layer);
        }

    }

    /**
     * @return string
     */
    public function getView(): string
    {
        return $this->view;
    }

    public function getIcon($icon): string
    {
        return '<object class="text-muted" height="16" type="image/svg+xml" data="' . asset('/images/viewer/' . $icon . '.svg') . '"></object>';
    }

}
