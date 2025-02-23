# CatSearch
With the extension, products, documents and product accessories can be tagged with categories.
Furthermore, the different types of data records can be related to each other so that, for example,
corresponding accessories or operating instructions can be assigned to a product.
A flexible detail page can also be used to show details for each product, document or product accessory.

The assigned categories can be used as filters to filter the data records via different plugins.
The filters can be grouped into filter-groups (facets) and can be freely combined by the editors of the website.
The extension also supports a free text search and comes with a ready-to-use interation with _ke_search_.

# Installation
Install the extension and then include the TypoScript.

# Plugins
The extension contains three central plugins:

## Search
The search plugin can be used to search products, product accessories or documents according to specific filter groups.
The filter groups can be customised.

A free text search, a search by year and a search for related products are also possible.
Each filter can also be defined as a multiple selection in the plugin.
It is also possible to pre-filter the display of records (include/exclude).
The search results can be sorted according to defined criteria via frontend.

## SearchRelated
This plugin can be installed below the search plugin. It accesses the search mask of the search plugin. This makes it possible, for example, to add accessories to the search results.

## TeaserFiltered
With this plugin, products, accessories or documents can be displayed according to defined criteria.

## Detail
This plugin displays the details of the respective data record.

# Settings
## TypoScript
Numerous settings can be made via TypoScript.
Two that require a little more explanation are explained in more detail here:

### sorting
A comma-separated list of database fields that can be sorted by. The field name is followed by either ‘asc’ for ascending sorting or ‘desc’ for descending sorting, separated by a hash.

### useSessionCookie
By default, all user search parameters are appended as parameters to the link for pagination, for example. Alternatively, this can also be saved in the FE session.

## ExtConf
Central settings can be made via the ExtConf.

### Primary filter
Up to five so-called primary filters can be defined for the data records.
This makes it possible to assign particularly important filters in separate fields.

## Integration with ke_search extension
This extension has a hook for integration with ke_search. The tables and fields to be indexed can be defined via the ExtConf.

## PageTitleProvider
The extension has an integrated PageTitle provider for the detailed view. The fields used can be set via the ExtConf.

## ContentElements
tt_content data records can also be assigned to the data records.
If you only want to allow specific content element to be added to the records of this extension,
you can define this in the extension-configuration in the backend.

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

## Individualisation of the fields of the data records
The ExtConf can be used to specify which fields should be hidden in the backend for product, document or accessory data records. This allows maximum customisation.

## Plugin header
The ExtConf can be used to specify whether certain plugin types can be created with or without headlines. This can be relevant for customising the display.

# Miscellaneous
## Layouts
The plugins offer the option of selecting different layouts, which can then be used in the templates for different displays.
To customise the layouts available for selection, proceed as follows:

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
Layouts can also be defined in the data records, which then change the layout depending on the data record.
To customise this, proceed as follows:
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
