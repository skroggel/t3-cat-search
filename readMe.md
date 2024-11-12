
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

        // customize field sub_type
        sub_type {
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
