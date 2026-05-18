#Disseny de pipelines d'agregació

##Pàgines més visitades

GROUP
  -  _id: url
  -  visites(count)

SORT
  -  visites: -1
  
LIMIT
  -  5

PROJECT
  -  _id: 0
  -  url: _id
  -  visites: 1


##Usuaris més actius

  GROUP
    -  _id: ip
    -  total (pàgines visitades)

  SORT
    -  total: -1

  LIMIT
    -  5

  PROJECT
    -  _id: 0
    -  IP: _id
    -  total


  ##Accessos per dia

  GROUP
    -  id: dayOfYear: data_inici_sessio
    - total sum: 1

  SORT
    - _id -1

  PROJECT
    -  _id 0
    -  data_inici_sessio
    -  total: 1

##Total d'accessos

  MATCH
    -  url: regex: index.php

  GROUP
    -  _id url
    - total_visites: sum 1

  PROJECT
    -  _id: 0
    -  total_visites: 1
    
