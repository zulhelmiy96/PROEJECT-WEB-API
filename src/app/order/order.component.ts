import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Order } from '../order';

@Component({
  selector: 'app-order',
  templateUrl: './order.component.html',
  styleUrls: ['./order.component.css']
})
export class OrderComponent implements OnInit {
  orderList: Order[];
  selectedOrder: Order = { orderID:null, chartID:null, custAlias:null, pizzaName:null, orderQuantity:null, totalPay:null, status:null};
  constructor(private apiService: ApiService) { }
  ngOnInit() {
    this.apiService.readOrderTable().subscribe((orderList: Order[])=>{
      this.orderList = orderList;
      console.log(this.orderList);
    })
  }
}