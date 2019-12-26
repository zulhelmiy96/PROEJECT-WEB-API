import { Component, OnInit } from '@angular/core';
import { ApiService } from '../api.service';
import { Pizza } from '../pizza';

@Component({
  selector: 'app-dashboard',
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.css']
})
export class DashboardComponent implements OnInit {

  policies:  Pizza[];
  selectedPolicy:  Pizza  = { pizzaID:null, pizzaName:null, pizzaPrice:null, pizzaStock:null};

  constructor(private apiService: ApiService) { }

  ngOnInit() {
    this.apiService.readPolicies().subscribe((policies: Pizza[])=>{
      this.policies = policies;
      console.log(this.policies);
    })
  }

  createOrUpdatePolicy(form){
    if(this.selectedPolicy && this.selectedPolicy.pizzaID){
      form.value.id = this.selectedPolicy.pizzaID;
      this.apiService.updatePolicy(form.value).subscribe((policy: Pizza)=>{
        console.log("Product updated" , policy);
      });
    }
    else{
      this.apiService.createPolicy(form.value).subscribe((policy: Pizza)=>{
        console.log("Product created, ", policy);
      });
    }
  }

  selectPolicy(policy: Pizza){
    this.selectedPolicy = policy;
  }

  deletePolicy(pizzaID){
    this.apiService.deletePolicy(pizzaID).subscribe((policy: Pizza)=>{
      console.log("Policy deleted, ", policy);
    });
  }
}