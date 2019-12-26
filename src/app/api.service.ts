import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Pizza } from  './pizza';
import { Order } from './order';
import { Observable } from  'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  PHP_API_SERVER = "http://127.0.0.1:8080";
  readPolicies(): Observable<Pizza[]>{
    return this.httpClient.get<Pizza[]>(`${this.PHP_API_SERVER}/api/read.php`);
  }
  createPolicy(policy: Pizza): Observable<Pizza>{
    return this.httpClient.post<Pizza>(`${this.PHP_API_SERVER}/api/create.php`, policy);
  }
  updatePolicy(policy: Pizza){
    return this.httpClient.put<Pizza>(`${this.PHP_API_SERVER}/api/update.php`, policy);   
  }
  deletePolicy(pizzaID: number){
    return this.httpClient.delete<Pizza>(`${this.PHP_API_SERVER}/api/delete.php/?pizzaID=${pizzaID}`);
  }
  readOrderTable(): Observable<Order[]>{
    return this.httpClient.get<Order[]>(`${this.PHP_API_SERVER}/api/readOrder.php`);
  }
  constructor(private httpClient: HttpClient) {}
}