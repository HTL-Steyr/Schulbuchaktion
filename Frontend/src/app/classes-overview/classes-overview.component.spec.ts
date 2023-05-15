import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ClassesOverviewComponent } from './classes-overview.component';

describe('ClassesOverviewComponent', () => {
  let component: ClassesOverviewComponent;
  let fixture: ComponentFixture<ClassesOverviewComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ClassesOverviewComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ClassesOverviewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
