<?php
namespace App\View\Components;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
class Alert extends Component
{
    public $type;
    public $dismissible;
    public $icon;
    public function __construct($type = 'info', $dismissible = true, $icon = null)
    {
        $this->type = $type;
        $this->dismissible = $dismissible;
        $this->icon = $icon;
    }
    public function backgroundClass()
    {
        return [
            'success' => 'bg-green-100 border-green-400 text-green-700',
            'danger' => 'bg-red-100 border-red-400 text-red-700',
            'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-700',
            'info' => 'bg-blue-100 border-blue-400 text-blue-700',
        ][$this->type] ?? 'bg-gray-100 border-gray-400 text-gray-700';

    }
    public function iconClass()
    {
        if ($this->icon) {
            return $this->icon;
        }
        return [
            'success' => 'fas fa-check-circle',
            'danger' => 'fas fa-exclamation-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'info' => 'fas fa-info-circle',
        ][$this->type] ?? 'fas fa-bell';
    }
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}