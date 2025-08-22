// application/helpers/ZendBarcodeHelper.php
<?php
class ZendBarcodeHelper
{
    public static function generateBarcodeDataUrl($text)
    {
        // Load Zend Barcode
        $barcodeOptions = array('text' => $text, 'factor' => 2);
        $rendererOptions = array();
        
        $renderer = new Zend_Barcode_Renderer_Image();
        $barcode = Zend_Barcode::factory('code128', 'image', $barcodeOptions, $rendererOptions);
        
        ob_start();
        $barcode->draw();
        $imageData = ob_get_clean();
        
        // Encode image data to base64
        $dataUrl = 'data:image/png;base64,' . base64_encode($imageData);
        
        return $dataUrl;
    }
}
?>
