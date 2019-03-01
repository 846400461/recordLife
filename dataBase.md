#### 用户纪念日信息表(dateTime)

|   字段   |   类型   |      约束或其他      |
| :------: | :------: | :------------------: |
|    id    |   int    |     primary key      |
|  userId  |   int    | Foreign key(User.id) |
| message  | varchar  |                      |
|   type   | tinyint  |                      |
| goodDate | datetime |                      |
| fileName | varchar  |                      |



#### 纪念日事件表(event)

|    字段    |   类型   |        约束或其他        |
| :--------: | :------: | :----------------------: |
|     id     |   int    |       primary key        |
| dateTimeId |   int    | Foreign key(dateTime.id) |
| eventTime  | datetime |                          |
|  message   | tinytext |                          |
|  fileName  | varchar  |                          |

