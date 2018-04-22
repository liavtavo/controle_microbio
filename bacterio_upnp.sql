--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: disp_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.disp_prelev (
    id integer NOT NULL,
    dispositif character varying(50) NOT NULL
);


ALTER TABLE public.disp_prelev OWNER TO thomas;

--
-- Name: disp_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.disp_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.disp_prelev_id_seq OWNER TO thomas;

--
-- Name: disp_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.disp_prelev_id_seq OWNED BY public.disp_prelev.id;


--
-- Name: jours_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.jours_prelev (
    id integer NOT NULL,
    jour character varying(10) NOT NULL
);


ALTER TABLE public.jours_prelev OWNER TO thomas;

--
-- Name: jours_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.jours_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.jours_prelev_id_seq OWNER TO thomas;

--
-- Name: jours_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.jours_prelev_id_seq OWNED BY public.jours_prelev.id;


--
-- Name: limites_classes; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.limites_classes (
    id integer NOT NULL,
    classe character varying(10) NOT NULL,
    type character varying(50) NOT NULL,
    limite integer NOT NULL
);


ALTER TABLE public.limites_classes OWNER TO thomas;

--
-- Name: limites_classes_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.limites_classes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.limites_classes_id_seq OWNER TO thomas;

--
-- Name: limites_classes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.limites_classes_id_seq OWNED BY public.limites_classes.id;


--
-- Name: planning_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.planning_prelev (
    id_jour integer NOT NULL,
    id_point integer NOT NULL
);


ALTER TABLE public.planning_prelev OWNER TO thomas;

--
-- Name: points_prelev; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.points_prelev (
    id integer NOT NULL,
    point character varying(10) NOT NULL,
    description character varying(50),
    id_disp integer NOT NULL,
    id_class integer NOT NULL
);


ALTER TABLE public.points_prelev OWNER TO thomas;

--
-- Name: points_prelev_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.points_prelev_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.points_prelev_id_seq OWNER TO thomas;

--
-- Name: points_prelev_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.points_prelev_id_seq OWNED BY public.points_prelev.id;


--
-- Name: prelevements; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.prelevements (
    id integer NOT NULL,
    fait boolean NOT NULL,
    date_prelev date NOT NULL,
    id_point integer NOT NULL
);


ALTER TABLE public.prelevements OWNER TO thomas;

--
-- Name: prelevements_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.prelevements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.prelevements_id_seq OWNER TO thomas;

--
-- Name: prelevements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.prelevements_id_seq OWNED BY public.prelevements.id;


--
-- Name: resultats; Type: TABLE; Schema: public; Owner: thomas; Tablespace: 
--

CREATE TABLE public.resultats (
    id integer NOT NULL,
    date_res date NOT NULL,
    tel boolean,
    nb_micro integer NOT NULL,
    micro character varying(100),
    id_prelev integer NOT NULL
);


ALTER TABLE public.resultats OWNER TO thomas;

--
-- Name: resultats_id_seq; Type: SEQUENCE; Schema: public; Owner: thomas
--

CREATE SEQUENCE public.resultats_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.resultats_id_seq OWNER TO thomas;

--
-- Name: resultats_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: thomas
--

ALTER SEQUENCE public.resultats_id_seq OWNED BY public.resultats.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.disp_prelev ALTER COLUMN id SET DEFAULT nextval('public.disp_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.jours_prelev ALTER COLUMN id SET DEFAULT nextval('public.jours_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.limites_classes ALTER COLUMN id SET DEFAULT nextval('public.limites_classes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev ALTER COLUMN id SET DEFAULT nextval('public.points_prelev_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.prelevements ALTER COLUMN id SET DEFAULT nextval('public.prelevements_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.resultats ALTER COLUMN id SET DEFAULT nextval('public.resultats_id_seq'::regclass);


--
-- Data for Name: disp_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.disp_prelev (id, dispositif) FROM stdin;
1	Ecouvillon
2	Boîte de Petri
3	Biocollecteur SamplR
4	Countact
\.


--
-- Name: disp_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.disp_prelev_id_seq', 4, true);


--
-- Data for Name: jours_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.jours_prelev (id, jour) FROM stdin;
1	lundi
2	mardi
3	mercredi
4	jeudi
5	vendredi
\.


--
-- Name: jours_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.jours_prelev_id_seq', 5, true);


--
-- Data for Name: limites_classes; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.limites_classes (id, classe, type, limite) FROM stdin;
1	A	Air	1
2	A	Surface	1
3	A	Gants	1
4	D	Air	100
5	D	Surface	50
\.


--
-- Name: limites_classes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.limites_classes_id_seq', 5, true);


--
-- Data for Name: planning_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.planning_prelev (id_jour, id_point) FROM stdin;
1	1
1	2
1	10
1	11
1	12
1	13
1	14
1	20
1	21
1	34
1	35
1	29
1	30
1	38
2	3
2	4
2	10
2	11
2	12
2	17
2	18
2	19
2	23
2	31
2	32
2	36
2	29
2	30
2	38
3	5
3	6
3	7
3	8
3	9
3	10
3	11
3	12
3	27
3	28
3	38
3	41
3	42
3	43
3	39
3	40
4	1
4	2
4	10
4	11
4	12
4	15
4	16
4	25
4	26
4	34
4	37
4	29
4	30
4	38
5	3
5	4
5	10
5	11
5	12
5	22
5	24
5	33
5	35
5	29
5	30
5	38
\.


--
-- Data for Name: points_prelev; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.points_prelev (id, point, description, id_disp, id_class) FROM stdin;
1	gant A	gant	2	3
2	gant B	gant	2	3
3	gant C	gant	2	3
4	gant D	gant	2	3
5	gant E	gant	2	3
6	gant F	gant	2	3
7	gant G	gant	2	3
8	gant H	gant	2	3
9	gant I	gant	2	3
10	point a	coin droit	2	1
11	point b	milieu	2	1
12	point c	coin gauche	2	1
13	point 1	manchette	1	2
14	point 2	manchette	1	2
15	point 3	manchette	1	2
16	point 4	manchette	1	2
17	point 5	manchette	1	2
18	point 6	manchette	1	2
19	point 7	manchette	1	2
20	point 8	coin plan de travail	1	2
21	point 11	coin plan de travail	1	2
22	point 9	DPTE sortie de secours	1	2
23	point 10	DPTE poubelle	1	2
24	point 12	rail mobile	1	2
25	point 13	bouton porte	1	2
26	point 14	poignée interporte	1	2
27	point 15	sas transfert	1	2
28	point 16	sas transfert	1	2
29	point 17	champ surface de travail	1	2
30	point 18	champ surface de travail	1	2
38	point 26	témoin négatif	1	2
31	point 19	automate zone tubulure centrale	1	2
32	point 20	automate façade	1	2
33	point 21	automate bouton allumage	1	2
34	point 22	bouton douchette	1	2
35	point 23	balance plateau	1	2
36	point 24	balance écran	1	2
37	point 25	automate écran	1	2
39	point d	air par boîte de Petri	2	4
40	point e	air par impaction	3	4
41	point 27	paillasse	4	5
42	point 28	paillasse	4	5
43	point 29	paillasse	4	5
\.


--
-- Name: points_prelev_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.points_prelev_id_seq', 43, true);


--
-- Data for Name: prelevements; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.prelevements (id, fait, date_prelev, id_point) FROM stdin;
\.


--
-- Name: prelevements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.prelevements_id_seq', 1, false);


--
-- Data for Name: resultats; Type: TABLE DATA; Schema: public; Owner: thomas
--

COPY public.resultats (id, date_res, tel, nb_micro, micro, id_prelev) FROM stdin;
\.


--
-- Name: resultats_id_seq; Type: SEQUENCE SET; Schema: public; Owner: thomas
--

SELECT pg_catalog.setval('public.resultats_id_seq', 1, false);


--
-- Name: disp_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.disp_prelev
    ADD CONSTRAINT disp_prelev_pkey PRIMARY KEY (id);


--
-- Name: jours_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.jours_prelev
    ADD CONSTRAINT jours_prelev_pkey PRIMARY KEY (id);


--
-- Name: limites_classes_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.limites_classes
    ADD CONSTRAINT limites_classes_pkey PRIMARY KEY (id);


--
-- Name: planning_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.planning_prelev
    ADD CONSTRAINT planning_prelev_pkey PRIMARY KEY (id_jour, id_point);


--
-- Name: points_prelev_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_pkey PRIMARY KEY (id);


--
-- Name: prelevements_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.prelevements
    ADD CONSTRAINT prelevements_pkey PRIMARY KEY (id);


--
-- Name: resultats_pkey; Type: CONSTRAINT; Schema: public; Owner: thomas; Tablespace: 
--

ALTER TABLE ONLY public.resultats
    ADD CONSTRAINT resultats_pkey PRIMARY KEY (id);


--
-- Name: planning_prelev_id_jour_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.planning_prelev
    ADD CONSTRAINT planning_prelev_id_jour_fkey FOREIGN KEY (id_jour) REFERENCES public.jours_prelev(id);


--
-- Name: points_prelev_id_class_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_id_class_fkey FOREIGN KEY (id_class) REFERENCES public.limites_classes(id);


--
-- Name: points_prelev_id_disp_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.points_prelev
    ADD CONSTRAINT points_prelev_id_disp_fkey FOREIGN KEY (id_disp) REFERENCES public.disp_prelev(id);


--
-- Name: resultats_id_prelev_fkey; Type: FK CONSTRAINT; Schema: public; Owner: thomas
--

ALTER TABLE ONLY public.resultats
    ADD CONSTRAINT resultats_id_prelev_fkey FOREIGN KEY (id_prelev) REFERENCES public.prelevements(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

