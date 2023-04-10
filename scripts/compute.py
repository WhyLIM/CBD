import json
import igraph
import urllib.request
import pandas as pd
import sys

# url = "https://string-db.org/api/json/network?identifiers=TP53"

url = sys.argv[1]
data = urllib.request.urlopen(url)
text = json.load(data)

edgelist = []
for i in text:
    edgelist.append((i["preferredName_A"], i["preferredName_B"]))

edgelist = list(set(edgelist))

g = igraph.Graph.TupleList(edgelist, directed=False)
symbol = g.vs["name"]
degree = g.degree(symbol)
betweenness = g.betweenness(symbol)
closeness = g.closeness(symbol)

df = pd.DataFrame(list(zip(symbol, degree, betweenness, closeness)),
                  columns=["Symbol", "Degree", "Betweenness", "Closeness"])
df_html = df.to_html(index=False, table_id="topopara", border=0)
print(df_html)
