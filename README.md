REST сервис для работы с бонусами
Авторизация к методам API через Basic Auth<br><br>
Зачисление/списание бонусов можно производить как напрямую, 
указывая сумму бонусов,так и через методы accrual и purchase, 
передавая сумму покупки<br><br>
Чтобы зачислить или списать напрямую:
1. Нужно запросить расчет бонусов через метод GET wallets/{wallet}/operations/calculate
2. Отправить запрос на зачисление бонусов в метод POST wallets/{wallet}/operations

Чтобы зачислить по сумме покупки:
- Передать сумму покупки purchase_money_amount в метод POST wallets/{wallet}/operations/accrual

Чтобы списать по сумме покупки:
- Передать сумму покупки purchase_money_amount в метод POST wallets/{wallet}/operations/purchase

Получить текущий баланс кошелька:
- Запросить метод GET wallets/{wallet}




