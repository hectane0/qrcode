<?php

namespace QrCode\Models\QR;

class QR
{
    public $text;
    public $fillColor;
    public $backgroundColor;
    public $image;


    /**
     * QR constructor.
     * @param String $text
     * @param String $fillColor
     * @param String $backgroundColor
     * @param null $image
     */
    public function __construct($text, $fillColor = "#000000", $backgroundColor = "#ffffff", $image = null)
    {
        $this->text = $text;
        $this->fillColor = $fillColor;
        $this->backgroundColor = $backgroundColor;
        $this->image = $image;
    }

    /**
     * Get png image encoded in base64
     *
     * @return string
     */
    public function getQRInBase64()
    {
        $command = $this->getCommand();
        $output = shell_exec($command);

        return $output;
    }

    /**
     * @return string
     */
    public function save()
    {
        $command = $this->getCommand(true);
        $output = shell_exec($command);
        return $output;
    }

    /**
     * Get command for image generating script
     *
     * @param bool $save
     * @return string
     */
    private function getCommand($save = false)
    {
        $envDir = APP_PATH . "/env/python";
        $scriptsDir = APP_PATH . "/scripts";

        $args = "-t " . escapeshellarg($this->text) . " -f " . escapeshellarg($this->fillColor) . " -b " .escapeshellarg($this->backgroundColor);

        if (isset($this->image)) {
            $args .= " -i " . escapeshellarg($this->image);
        }

        if ($save) {
            $args .= " -s";
        }

        $cmd = "source $envDir/bin/activate; $envDir/bin/python $scriptsDir/qr-generate.py $args 2>&1";

        return $cmd;
    }
}
