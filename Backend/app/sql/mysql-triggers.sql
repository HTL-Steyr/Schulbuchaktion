create definer = symfony@`%` trigger t_create_book_order
    before insert
    on book_order
    for each row
BEGIN
    DECLARE priceEbookBook INTEGER DEFAULT 0;
    DECLARE priceBook INTEGER DEFAULT 0;
    DECLARE totalPrice INTEGER DEFAULT 0;
    DECLARE departmentId INTEGER DEFAULT 0;
    DECLARE usedBudgetSchoolclass INTEGER DEFAULT 0;
    DECLARE usedBudgetDepartment INTEGER DEFAULT 0;

    SELECT department_id FROM school_class WHERE school_class.id = NEW.school_class_id INTO departmentId;

    SELECT price_inclusive_ebook - book_price.price_ebook
    FROM book_price
    WHERE book_price.book_id =
          NEW.book_id
    INTO priceBook;

    IF (NEW.ebook_plus)
    THEN
        SELECT price_ebook_plus + (price_inclusive_ebook - book_price.price_ebook)
        FROM book_price
        WHERE book_price.book_id =
              NEW.book_id
        INTO priceEbookBook;
    ELSE
        IF (NEW.ebook)
        THEN
            SELECT price_ebook
            FROM book_price
            WHERE book_price.book_id =
                  NEW.book_id
            INTO priceEbookBook;
        END IF;
    END IF;

    SET
        totalPrice = (priceBook + priceEbookBook) * NEW.count;

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

