--
-- PostgreSQL database dump
--

-- Dumped from database version 11.5
-- Dumped by pg_dump version 11.5

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: airplane; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.airplane (
    id integer NOT NULL,
    type character varying(5) NOT NULL,
    airline character varying(20) NOT NULL
);


ALTER TABLE public.airplane OWNER TO postgres;

--
-- Name: airport; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.airport (
    code character varying(10) NOT NULL,
    name character varying(100) NOT NULL
);


ALTER TABLE public.airport OWNER TO postgres;

--
-- Name: book; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.book (
    id integer NOT NULL,
    "time" character varying(30) NOT NULL,
    date character varying(30) NOT NULL,
    fnum integer NOT NULL,
    username character varying(50) NOT NULL,
    classtype character(20) NOT NULL,
    paid integer
);


ALTER TABLE public.book OWNER TO postgres;

--
-- Name: book_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.book_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.book_id_seq OWNER TO postgres;

--
-- Name: book_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.book_id_seq OWNED BY public.book.id;


--
-- Name: flights; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.flights (
    air_id integer NOT NULL,
    source character varying NOT NULL,
    destination character varying NOT NULL,
    d_time character varying NOT NULL,
    a_time character varying NOT NULL,
    fnum integer NOT NULL
);


ALTER TABLE public.flights OWNER TO postgres;

--
-- Name: flights_number_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.flights_number_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.flights_number_seq OWNER TO postgres;

--
-- Name: flights_number_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.flights_number_seq OWNED BY public.flights.fnum;


--
-- Name: passenger; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.passenger (
    fname character(30) NOT NULL,
    gender character(10) NOT NULL,
    age character varying(30) NOT NULL,
    pnr integer
);


ALTER TABLE public.passenger OWNER TO postgres;

--
-- Name: price; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.price (
    fnum integer NOT NULL,
    name character(15) NOT NULL,
    capacity integer NOT NULL,
    cost numeric(10,0) NOT NULL
);


ALTER TABLE public.price OWNER TO postgres;

--
-- Name: register; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.register (
    username character varying(50) NOT NULL,
    password character varying(15) NOT NULL
);


ALTER TABLE public.register OWNER TO postgres;

--
-- Name: book id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book ALTER COLUMN id SET DEFAULT nextval('public.book_id_seq'::regclass);


--
-- Name: flights fnum; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flights ALTER COLUMN fnum SET DEFAULT nextval('public.flights_number_seq'::regclass);


--
-- Data for Name: airplane; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.airplane (id, type, airline) FROM stdin;
1100	A320	Air India
1101	A321	Air India
1102	A321	IndiGO
1103	ATR72	IndiGO
1104	B737	Spice Jet
1105	BQ400	Spice Jet
\.


--
-- Data for Name: airport; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.airport (code, name) FROM stdin;
BLR	Bangalore Bengaluru International Airport
HYD	Hyderabad Rajiv Gandhi International Airport
MAA	Chennai Meenambarkkam International Airport
CCU	Kolkata Netaji Subhash Chandra Bose
DEL	New Delhi Indira Gandhi International Airport
AMD	Ahmedabad SD Vallabhbhai Patel International Airport
GOI	Dabolim Goa International Airport
COK	Cochin Airport, Kerala Cochin International Airport
BOM	Mumbai Chattrapathi Shivaji International Airport
\.


--
-- Data for Name: book; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.book (id, "time", date, fnum, username, classtype, paid) FROM stdin;
40	2019-10-20 09:48:33	10/25/2019	25	shoaibhs19@gmail.com	Business            	1
41	2019-10-20 10:03:42	10/03/2019	27	shoaibhs19@gmail.com	Business            	1
42	2019-11-05 11:57:02	11/08/2019	25	shoaib.shaikh@somaiya.edu	Economy             	1
43	2019-11-06 11:21:01	11/07/2019	25	shoaib.shaikh@somaiya.edu	Economy             	0
\.


--
-- Data for Name: flights; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.flights (air_id, source, destination, d_time, a_time, fnum) FROM stdin;
1100	BLR	BOM	01:01	15:02	22
1100	BLR	BOM	01:01	15:02	23
1103	BOM	BLR	12:01	14:01	25
1104	BLR	BOM	02:02	07:00	27
1105	HYD	MAA	02:00	04:00	28
1102	BLR	CCU	00:01	03:01	24
1101	MAA	DEL	02:02	05:04	20
1100	BOM	BLR	02:02	21:01	26
\.


--
-- Data for Name: passenger; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.passenger (fname, gender, age, pnr) FROM stdin;
Shoaib Shaikh                 	Male      	21	40
Sara Morgan                   	Female    	45	41
Shoaib Shaikh                 	Male      	20	42
Shoaib Shaikh                 	Male      	20	43
\.


--
-- Data for Name: price; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.price (fnum, name, capacity, cost) FROM stdin;
20	Economy        	200	1500
24	Business       	50	2500
25	Economy        	200	1500
25	Business       	25	2500
26	Economy        	200	2000
26	Business       	15	5000
27	Economy        	150	1500
27	Business       	25	4000
28	Economy        	250	1500
28	Business       	50	5000
20	Business       	60	4000
24	Economy        	150	2400
\.


--
-- Data for Name: register; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.register (username, password) FROM stdin;
ADMIN	hawaiadda@srs
shoaib.shaikh@somaiya.edu	123
shoaibhs19@gmail.com	123
rajeswari@somaiya.edu	123
swati@somaiya.edu	123
rajeshwari@somaiya.edu	123
jinisha@somaiya.edu	jini123
\.


--
-- Name: book_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.book_id_seq', 43, true);


--
-- Name: flights_number_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.flights_number_seq', 28, true);


--
-- Name: airplane airplane_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.airplane
    ADD CONSTRAINT airplane_pkey PRIMARY KEY (id);


--
-- Name: airport airport_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.airport
    ADD CONSTRAINT airport_pkey PRIMARY KEY (code);


--
-- Name: book book_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.book
    ADD CONSTRAINT book_pkey PRIMARY KEY (id);


--
-- Name: flights flights_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flights
    ADD CONSTRAINT flights_pkey PRIMARY KEY (fnum);


--
-- Name: register register_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.register
    ADD CONSTRAINT register_pkey PRIMARY KEY (username);


--
-- Name: flights fk2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.flights
    ADD CONSTRAINT fk2 FOREIGN KEY (air_id) REFERENCES public.airplane(id);


--
-- Name: price fk3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.price
    ADD CONSTRAINT fk3 FOREIGN KEY (fnum) REFERENCES public.flights(fnum) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

