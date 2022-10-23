
library(igraph, lib.loc="../../../../home/lim/R/x86_64-pc-linux-gnu-library/4.2/")
library(tidyverse, lib.loc="/home/lim/R/x86_64-pc-linux-gnu-library/4.2/")
library(jsonlite, lib.loc="/home/lim/R/x86_64-pc-linux-gnu-library/4.2/")

rm(list = ls())
# edges <- read.table("network.tsv", header = T, stringsAsFactors = F)[, 3:4]
edges <- read.table("https://string-db.org/api/tsv/network?identifiers=TP53", header = T, stringsAsFactors = F)[, 3:4]

nodes <- unique(c(edges[, 1], edges[, 2]))

net <- graph_from_data_frame(d = edges, vertices = nodes, directed = F)

degree <- data.frame("name" = names(degree(net, V(net))), "value" = degree(net, V(net)))
betweenness <- data.frame("name" = names(betweenness(net, V(net))), "value" = betweenness(net, V(net)))
closeness <- data.frame("name" = names(closeness(net, V(net))), "value" = closeness(net, V(net)))

para <- merge(degree, betweenness, by = "name") %>% 
  merge(closeness, by = "name")

names(para) <- c("Symbol", "Degree", "Betweenness", "Closeness")

parajson <- toJSON(para, pretty=TRUE)
print(parajson)

# cat(parajson, file = (con <- file('json.txt', "w", encoding = "UTF-8")))
# close(con)

# write.csv(para, "para.csv", row.names = F)
