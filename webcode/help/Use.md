## How to Search

We offer users three different ways to retrieve data: Categorical Search, Keyword Search, and Advanced Search. Each search strategy returns results with detailed information about the corresponding biomarker.

### Categorical Search

Users can access biomarker data through the menu on the left side of the "Biomarkers" page. There are currently four major categories: Protein, RNA, DNA and Other, and clicking on a menu item will display a list of all the corresponding biomarkers on the right side. If there is a subcategory under a major category, the relevant submenu will appear when the user clicks on the menu item. Once the user clicks on one of the markers in the biomarker list, the interface will jump to the information page. (Figure 1)

![Figure 1](https://cbd.limina.top/images/search_category.png)

### Keyword Search

The second way to search the users needed marker is the key word search: input a biomarker name and then click the “search” button. It will turn to a result page including the relevant biomarker’s information. (Figure 2)

![Figure 2](https://cbd.limina.top/images/search_keyword.png)

### Advanced Search

Besides upon two ways, our database also provides the advanced search function: after click the "Advanced Search" button, an advanced search interface will appear. Six keywords are currently supported including region of study (Region), cancer stage (Stage), major cancer area (Location), marker source (Source), marker usage (Application), and information of published literature (Reference). (Figure 3)

![Figure 3](https://cbd.limina.top/images/search_advance.png)

## How to Explore

### Network Display

The left area of the discovery page provides a list of biomarkers and input boxes for users to select and type in the biomarkers of interest, and the result network will be displayed on the right after clicking the "Query" button. Note that if only one protein is queried, then the results will display its network with 10 other highest confidence interacting proteins by default, and we have set the default query to TP53. And considering the browser performance and access speed, we do not show the network analysis information for the default query, users can click the "Query" button to get these results by themselves.

![Figure 4](https://cbd.limina.top/images/explore_net.png)

### Network Analysis

The network analysis output contains three parts: Network Stats, Topological Parameters, and Functional Enrichments. Network Stats shows the basic information of the current network. Topological parameters consists with three classical centrality parameters: Degree, Betweenness and Closeness, calculated by igraph-python. We provide the normalized closeness value, help users to compare nodes in different networks. Functional Enrichments gives 16 types of enrichment information from different database resources, which are marked by different colors and can be accessed directly through hyperlinks, with the color correspondence displayed above the table.

![Figure 5](https://cbd.limina.top/images/explore_analysis.png)
