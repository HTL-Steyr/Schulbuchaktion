CREATE TRIGGER t_create_book_order
    AFTER INSERT
    ON book_order
    FOR EACH ROW
BEGIN
    DECLARE pricePerBook INTEGER;
    DECLARE totalPrice INTEGER;
    DECLARE schoolClassId INTEGER;
    DECLARE departmentId INTEGER;

    SELECT school_class_id_id FROM book_order INTO schoolClassId;
    SELECT department_id_id FROM school_class WHERE school_class.id = schoolClassId INTO departmentId;

    IF (SELECT ebook_plus
        FROM book_order
        WHERE id = last_insert_id())
    THEN
        SELECT price_ebook_plus + (price_inclusive_ebook - book_price.price_ebook)
        FROM book_price
        WHERE book_price.book_id_id =
              (SELECT book_order.book_id_id FROM book_order WHERE id = last_insert_id())
        INTO pricePerBook;
    ELSE
        IF (SELECT ebook FROM book_order WHERE id = last_insert_id())
        THEN
            SELECT price_inclusive_ebook
            FROM book_price
            WHERE book_price.book_id_id =
                  (SELECT book_order.book_id_id FROM book_order WHERE id = last_insert_id())
            INTO pricePerBook;
        ELSE
            SELECT price_inclusive_ebook - book_price.price_ebook
            FROM book_price
            WHERE book_price.book_id_id =
                  (SELECT book_order.book_id_id FROM book_order WHERE id = last_insert_id())
            INTO pricePerBook;
        END IF;
    END IF;

    SET
        totalPrice = pricePerBook * (SELECT count FROM book_order WHERE id = last_insert_id());

    UPDATE book_order
    SET price=totalPrice
    WHERE id = last_insert_id();

    UPDATE school_class
    SET used_budget=(totalPrice + (SELECT used_budget
                                   FROM school_class
                                   WHERE school_class.id = schoolClassId))
    WHERE id = schoolClassId;

    UPDATE department
    SET used_budget=(totalPrice + (SELECT used_budget
                                   FROM department
                                   WHERE department.id = departmentId))
    WHERE id = departmentId;
END;
