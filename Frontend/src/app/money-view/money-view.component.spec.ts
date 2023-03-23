import { ComponentFixture, TestBed } from '@angular/core/testing';

import { MoneyViewComponent } from './money-view.component';

describe('MoneyViewComponent', () => {
  let component: MoneyViewComponent;
  let fixture: ComponentFixture<MoneyViewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ MoneyViewComponent ]
    })
      .compileComponents();
  });

  beforeEach(() => {
    fixture = TestBed.createComponent(MoneyViewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
