import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LoginErrorAlertComponent } from './login-error-alert.component';

describe('LoginErrorAlertComponent', () => {
  let component: LoginErrorAlertComponent;
  let fixture: ComponentFixture<LoginErrorAlertComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ LoginErrorAlertComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(LoginErrorAlertComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
