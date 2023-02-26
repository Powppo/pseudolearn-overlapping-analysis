import { Component, OnInit, AfterViewInit, ViewEncapsulation } from '@angular/core';
import { ScriptLoaderService } from '../../_services/script-loader.service';

@Component({
  selector: 'app-calendar',
  templateUrl: './calendar.component.html',
})
export class CalendarComponent implements OnInit, AfterViewInit {

  constructor(private _script: ScriptLoaderService) { }

  ngOnInit() {}

  ngAfterViewInit() {
    this._script.load('{{ asset('backend/html/dist/assets/vendors/jquery-ui/jquery-ui.min.js', '{{ asset('backend/html/dist/assets//js/scripts/calendar-demo.js');
  }

}
