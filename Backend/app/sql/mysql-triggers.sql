create definer = symfony@`%` trigger t_create_book_order
    before insert
    on book_order
    for each row
BEGIN
    DECLARE priceEbook INTEGER DEFAULT 0;
    DECLARE priceBase INTEGER DEFAULT 0;
    DECLARE totalPrice INTEGER DEFAULT 0;
    DECLARE departmentId INTEGER DEFAULT 0;
    DECLARE usedBudgetSchoolclass INTEGER DEFAULT 0;
    DECLARE usedBudgetDepartment INTEGER DEFAULT 0;

    SELECT department_id FROM school_class WHERE school_class.id = NEW.school_class_id INTO departmentId;

    SELECT bookprice.priceBase
    FROM book_price
    WHERE book_price.book_id =
          NEW.book_id
    INTO price_base;

    IF (NEW.ebook)
    THEN
        SELECT price_ebook
        FROM book_price
        WHERE book_price.book_id =
              NEW.book_id
        INTO priceEbook;
    END IF;

    SET totalPrice = (priceBase + priceEbook) * NEW.count;

    SET NEW.price = totalPrice;

    SELECT school_class.used_budget
    FROM school_class
    WHERE school_class.id = NEW.school_class_id
    INTO usedBudgetSchoolclass;

    SELECT department.used_budget
    FROM department
    WHERE department.id = departmentId
    INTO usedBudgetDepartment;

    UPDATE school_class
    SET school_class.used_budget=(totalPrice + usedBudgetSchoolclass)
    WHERE school_class.id = NEW.school_class_id;

    UPDATE department
    SET department.used_budget=(totalPrice + usedBudgetDepartment)
    WHERE department.id = departmentId;

END;

