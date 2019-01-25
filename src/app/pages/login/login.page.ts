import { Component, OnInit } from '@angular/core';
import { AlertController, NavController, LoadingController } from '@ionic/angular';
import { UrlService } from '../../provider/url.service';
import { map } from 'rxjs/operators';
import { Http } from  '@angular/http';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
})

export class LoginPage implements OnInit {

    username: string;
    password: string;

    constructor(public alert:AlertController, public urlService: UrlService, public http: Http, public nav: NavController, public loading: LoadingController) { 

    }

    ngOnInit() {

    }

    async logar(){
  
        if(this.username == undefined || this.password == undefined){

            this.urlService.alertas("Atenção", "<small>Preencha todos os campos do login</small>")
            // const alert = await this.alert.create({
            //     header: "Atenção",
            //     message: "<small>Preencha todos os campos do login</small>",
            //     buttons: ['OK']
            // });
            // await alert.present();

        } else {

            const load = await this.loading.create({
                spinner: "circles",
                message: "Verificando login"
            });
            await load.present();

            this.http.get(this.urlService.getUrl()+"login.php?username="+this.username+"&password="+this.password+"")
            .pipe(map(res => res.json()))
            .subscribe(
                data => {

                    if(data.msg.logado == "sim"){
                        if(data.dados.status == 1){

                            load.dismiss();
                            this.nav.navigateBack('home');
                        } else {

                            load.dismiss();
                            this.urlService.alertas("Atenção", "<small>Dados de login inválidos</small>")
                        }
                    } else {

                        load.dismiss();
                        this.urlService.alertas("Atenção", "<small>Dados de login inválidos</small>")
                    }
                }
            )
        }
    }

}
