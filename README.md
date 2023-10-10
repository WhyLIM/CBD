> Front-end code of Colorectal Cancer Biomarker Database (CBD).

# Quick Start

<div>
    <video src="./videos/Tutorial.mp4" width="100%" controls="controls"></video>
</div>

## How to Use

---

### How to Search

We offer users three different ways to retrieve data: Categorical Search, Keyword Search, and Advanced Search. Each search strategy returns results with detailed information about the corresponding biomarker.

#### Categorical Search

Users can access biomarker data through the menu on the left side of the "Biomarkers" page. There are currently four major categories: Protein, RNA, DNA and Other, and clicking on a menu item will display a list of all the corresponding biomarkers on the right side. If there is a subcategory under a major category, the relevant submenu will appear when the user clicks on the menu item. Once the user clicks on one of the markers in the biomarker list, the interface will jump to the information page. (Figure 1)

![Figure 1](../images/search_category.png "Figure 1. Search by category")

#### Keyword Search

The second way to search the users needed marker is the key word search: input a biomarker name and then click the “search” button. It will turn to a result page including the relevant biomarker’s information. (Figure 2)

![Figure 2](../images/search_keyword.png "Figure 2. Search by key word")

#### Advanced Search

Besides upon two ways, our database also provides the advanced search function: after click the "Advanced Search" button, an advanced search interface will appear. Six keywords are currently supported including region of study (Region), cancer stage (Stage), major cancer area (Location), marker source (Source), marker usage (Application), and information of published literature (Reference). (Figure 3)

![Figure 3](../images/search_advance.png "Figure 3. Advanced Search")

### How to Explore

#### Network Display

Figure 4 below is our "Explore" page.

![Figure 4](../images/explore.png "Figure 4. Explore page")

The left area of the page provides biomarker input and parameter selection. Users can select or input biomarkers of interest in three ways: 1) directly select the biomarkers stored in CBD2 2) upload txt or csv files 3) Type directly in the text box. After clicking the "Submit" button, the resulting network will be displayed on the upper right. Note that if only one protein is queried, the results will by default show the 10 other proteins whose network interacts with the highest confidence, we have set the default query to TP53. (Figure 5)

![Figure 5](../images/explore_net.png "Figure 5. Network display")

#### Network Analysis

At the same time, after the user clicks the "Submit" button, we will also return the list of network parameters and the list of enrichment analysis. By clicking the result entry id of the enrichment analysis, the user can jump to the result page of the corresponding database. (Figure 6)

![Figure 6](../images/explore_analysis.png "Figure 5. Network analysis")

#### Download

The network image and network parameters could be downloaded by clicking the "Download" button.