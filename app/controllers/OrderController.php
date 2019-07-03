<?php
class OrderController extends ApplicationController
{
    public function new()
    {
        if (empty($this->params['products'])) {
            Routing::generatePathAndRedirect('root_path');
        }

        return $this->render();
    }
}
