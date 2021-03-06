<?php
namespace CPSIT\MaskExport\Aggregate;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Nicole Cordes <typo3@cordes.co>, CPS-IT GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

class ExtensionConfigurationAggregate extends AbstractAggregate implements PhpAwareInterface, PlainTextFileAwareInterface
{
    use PhpAwareTrait;
    use PlainTextFileAwareTrait;

    /**
     * Adds typical extension files
     */
    protected function process()
    {
        $this->addExtEmconf();
        $this->addExtIcon();
    }

    /**
     * Adds ext_emconf.php file
     */
    protected function addExtEmconf()
    {
        $typo3Constraint = sprintf('%s.0-%s.99', TYPO3_branch, TYPO3_branch);
        $this->addPhpFile(
            'ext_emconf.php',
<<<EOS
\$EM_CONF[\$_EXTKEY] = array(
    'title' => 'mask',
    'description' => '',
    'category' => 'fe',
    'author' => '',
    'author_email' => '',
    'author_company' => '',
    'state' => 'stable',
    'version' => '0.1.0',
    'constraints' => array(
        'depends' => array(
            'typo3' => '{$typo3Constraint}',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
);

EOS
        );
    }

    /**
     * Adds ext_icon.png from mask_export extension
     */
    protected function addExtIcon()
    {
        $this->addPlainTextFile(
            'ext_icon.png',
            file_get_contents(ExtensionManagementUtility::extPath('mask_export') . 'ext_icon.png')
        );
    }
}
