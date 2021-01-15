<?php return array (
  'barryvdh/laravel-debugbar' => 
  array (
    'providers' => 
    array (
      0 => 'Barryvdh\\Debugbar\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'Debugbar' => 'Barryvdh\\Debugbar\\Facade',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'maatwebsite/excel' => 
  array (
    'providers' => 
    array (
      0 => 'Maatwebsite\\Excel\\ExcelServiceProvider',
    ),
    'aliases' => 
    array (
      'Excel' => 'Maatwebsite\\Excel\\Facades\\Excel',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'samuelterra22/laravel-report-generator' => 
  array (
    'providers' => 
    array (
      0 => 'SamuelTerra22\\ReportGenerator\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'PdfReport' => 'SamuelTerra22\\ReportGenerator\\Facades\\PdfReportFacade',
      'ExcelReport' => 'SamuelTerra22\\ReportGenerator\\Facades\\ExcelReportFacade',
      'CSVReport' => 'SamuelTerra22\\ReportGenerator\\Facades\\CSVReportFacade::class',
    ),
  ),
);