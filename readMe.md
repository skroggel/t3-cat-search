
## Set custom options in layout-field of FlexForm
```
// Important: You have to specifiy the extension-plugin (e.g. catsearch_search)
// AND the tab in the flexform (e.g. view) correctly
TCEFORM.tt_content.pi_flexform.catsearch_search.view.settings\.layout {

    // add new option "List"
    addItems.list = List

    // Override label of existing option "default"
    altLabels.default = Slot

    // remove option "big"
    removeItems = big
}
```

## Set custom options in backend-field of data-sets
```
TCEFORM {

	tx_catsearch_domain_model_filterable {

        // customize field
        layout {
            // add new option "List"
            addItems.list = List

            // Override label of existing option "default"
            altLabels.default = Slot

            // remove option "big"
            removeItems = big
        }
    }
}
```

## Set custom cTypes for related content-elements
If you only want to allow specific content element to be added to the records of this extension, you can define this in the extension-configuration in the backend.

**contentElementsAllowedCTypes** sets the allowed cType. Use a semicolon-separated list. Each entry consists of the value and the label, separated by comma.
The following example would add the cTypes header and text with the Labels "Super Header" and "Super Text":
```
header,Super Header;text,Super Text
```
If you override the allowed cTypes with **contentElementsDefaultCType** you also should set the default cType. Otherwise TYPO3 will use the cType "text" as default - no matter if you allowed it or not.
This can lead to unexpected results. The following example sets "header" as new default cType
```
header
```

## Customizing TCA
Here are some common examples for customizing the backend fields
```
// remove description-field for products only by removing it from the specific palette
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['palettes']['description_product']['showitem'] =
    str_replace('description,', '', $GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['palettes']['description_product']['showitem']);

// add RTE to header-field
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['header']['config']['type'] = 'text';
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['header']['config']['enableRichtext'] = true;
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['header']['config']['richtextConfiguration'] = 'YourConfig';

// set maxItems for images
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['images']['config']['maxitems'] = 8;

// remove downloads-field completely
$GLOBALS['TCA']['tx_catsearch_domain_model_filterable']['columns']['downloads']['config']['type'] = 'passthrough';

```
