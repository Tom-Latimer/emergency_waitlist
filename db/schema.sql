-- Table: public.patient

-- DROP TABLE IF EXISTS public.patient;

CREATE TABLE IF NOT EXISTS public.patient
(
    patient_id integer GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    first_name text COLLATE pg_catalog."default" NOT NULL,
    last_name text COLLATE pg_catalog."default" NOT NULL,
    email text COLLATE pg_catalog."default" NOT NULL,
    phone text COLLATE pg_catalog."default" NOT NULL,
    home_address text COLLATE pg_catalog."default" NOT NULL,
    medicine text COLLATE pg_catalog."default",
    blood_type text COLLATE pg_catalog."default" NOT NULL,
    dob text COLLATE pg_catalog."default" NOT NULL
)
TABLESPACE pg_default;

ALTER TABLE IF EXISTS public.patient
    OWNER to postgres;
