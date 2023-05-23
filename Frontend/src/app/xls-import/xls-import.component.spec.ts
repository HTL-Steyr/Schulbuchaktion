import { ComponentFixture, TestBed } from '@angular/core/testing';

import { XlsImportComponent } from './xls-import.component';

describe('XlsImportComponent', () => {
  let component: XlsImportComponent;
  let fixture: ComponentFixture<XlsImportComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ XlsImportComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(XlsImportComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
