/*==============================================================*/
/* Nom de SGBD :  Sybase SQL Anywhere 12                        */
/* Date de cr�ation :  16/12/2024 09:29:13                      */
/*==============================================================*/

drop index if exists ACTIVITE_PK cascade;
drop table if exists ACTIVITE cascade;
drop index if exists A_ENREGISTRE_FK cascade;
drop index if exists LOCALISE_FK cascade;
drop index if exists ADRESSE_PK cascade;
drop table if exists ADRESSE cascade;
drop index if exists APPARTIENT_5_FK cascade;
drop index if exists APPARTIENT_1_FK cascade;
drop index if exists APPARTIENT_1_PK cascade;
drop table if exists APPARTIENT_1 cascade;
drop index if exists APPARTIENT_4_FK cascade;
drop index if exists APPARTIENT_2_FK cascade;
drop index if exists APPARTIENT_2_PK cascade;
drop table if exists APPARTIENT_2 cascade;
drop index if exists APPARTIENT_7_FK cascade;
drop index if exists APPARTIENT_6_FK cascade;
drop index if exists APPARTIENT_4_PK cascade;
drop table if exists APPARTIENT_4 cascade;
drop index if exists ASSOCIATION_39_FK cascade;
drop index if exists ASSOCIATION_38_FK cascade;
drop index if exists ASSOCIATION_38_PK cascade;
drop table if exists ASSOCIATION_38 cascade;
drop index if exists mange1_FK cascade;
drop index if exists ASSOCIATION_40_FK cascade;
drop index if exists ASSOCIATION_39_PK cascade;
drop table if exists ASSOCIATION_39 cascade;
drop index if exists ASSOCIATION_46_FK cascade;
drop index if exists ASSOCIATION_45_FK cascade;
drop index if exists ASSOCIATION_40_PK cascade;
drop table if exists ASSOCIATION_40 cascade;
drop index if exists ASSOCIATION_48_FK cascade;
drop index if exists ASSOCIATION_47_FK cascade;
drop index if exists mange1_PK cascade;
drop table if exists mange1 cascade;
drop index if exists AUTRESOCIETE_PK cascade;
drop table if exists AUTRESOCIETE cascade;
drop index if exists POSTE_FK cascade;
drop index if exists CRITIQUE_FK cascade;
drop index if exists AVIS_PK cascade;
drop table if exists AVIS cascade;
drop index if exists DETIENT_FK cascade;
drop index if exists CARTE_BANCAIRE_PK cascade;
drop table if exists CARTE_BANCAIRE cascade;
drop index if exists CATEGORIEPARTICIPANT_PK cascade;
drop table if exists CATEGORIEPARTICIPANT cascade;
drop index if exists CATEGORIESEJOUR_PK cascade;
drop table if exists CATEGORIESEJOUR cascade;
drop index if exists CATEGORIEVIGNOBLE_PK cascade;
drop table if exists CATEGORIEVIGNOBLE cascade;
drop index if exists FAIT_DEGUSTER_FK cascade;
drop index if exists CAVE_PK cascade;
drop table if exists CAVE cascade;
drop index if exists CHATBOT_PK cascade;
drop table if exists CHATBOT cascade;
drop index if exists ASSOCIATION_43_FK cascade;
drop index if exists CLIENT_PK cascade;
drop table if exists CLIENT cascade;
drop index if exists BENEFICIAIRE_FK cascade;
drop index if exists ASSOCIE2_FK cascade;
drop index if exists LIVREA_FK cascade;
drop index if exists FACTUREA_FK cascade;
drop index if exists REALISE_FK cascade;
drop index if exists COMMANDE_PK cascade;
drop table if exists COMMANDE cascade;
drop index if exists ASSOCIATION_44_FK cascade;
drop index if exists ASSOCIATION_41_FK cascade;
drop index if exists ASSOCIATION_36_FK cascade;
drop index if exists ASSOCIATION_35_FK cascade;
drop index if exists DESCRIPTIONCOMMANDE_PK cascade;
drop table if exists DESCRIPTIONCOMMANDE cascade;
drop index if exists ASSOCIATION_37_FK cascade;
drop index if exists DECRIT_PANIER_FK cascade;
drop index if exists DECRIT_SEJOUR_PANIER_FK cascade;
drop index if exists DESCRIPTIONPANIER_PK cascade;
drop table if exists DESCRIPTIONPANIER cascade;
drop index if exists DUREE_PK cascade;
drop table if exists DUREE cascade;
drop index if exists APPARTIENT_3_FK cascade;
drop index if exists POSSEDE_FK cascade;
drop index if exists ETAPE_PK cascade;
drop table if exists ETAPE cascade;
drop index if exists FAVORIS2_FK cascade;
drop index if exists FAVORIS_FK cascade;
drop index if exists FAVORIS_PK cascade;
drop table if exists FAVORIS cascade;
drop index if exists PROPOSE_3_FK cascade;
drop index if exists HEBERGEMENT_PK cascade;
drop table if exists HEBERGEMENT cascade;
drop index if exists HOTEL_PK cascade;
drop table if exists HOTEL cascade;
drop index if exists A_FK cascade;
drop index if exists LOCALITE_PK cascade;
drop table if exists LOCALITE cascade;
drop index if exists PANIER_PK cascade;
drop table if exists PANIER cascade;
drop index if exists PARTENAIRE_PK cascade;
drop table if exists PARTENAIRE cascade;
drop index if exists PROPOSE_6_FK cascade;
drop index if exists PROPOSE_5_FK cascade;
drop index if exists PROPOSE_4_FK cascade;
drop index if exists PROPOSE_4_PK cascade;
drop table if exists PROPOSE_4 cascade;
drop index if exists PROPOSE_2_FK cascade;
drop index if exists REPAS_PK cascade;
drop table if exists REPAS cascade;
drop index if exists CUISINE_FK cascade;
drop index if exists RESTAURANT_PK cascade;
drop table if exists RESTAURANT cascade;
drop index if exists ROLES_PK cascade;
drop table if exists ROLES cascade;
drop index if exists ROUTE_DES_VINS.ROUTE_DES_VINS_PK cascade;
drop table if exists ROUTE_DES_VINS cascade;
drop index if exists DURE_FK cascade;
drop index if exists REGROUPE_FK cascade;
drop index if exists DESTINE_A_FK cascade;
drop index if exists DEFINIT_FK cascade;
drop index if exists CATEGORISE_FK cascade;
drop index if exists SEJOUR_PK cascade;
drop table if exists SEJOUR cascade;
drop index if exists SE_LOCALISE2_FK cascade;
drop index if exists SE_LOCALISE_FK cascade;
drop index if exists SE_LOCALISE_PK cascade;
drop table if exists SE_LOCALISE cascade;
drop index if exists THEME_PK cascade;
drop table if exists THEME cascade;
drop index if exists TYPECUISINE_PK cascade;
drop table if exists TYPECUISINE cascade;
drop index if exists TYPEDEGUSTATION_PK cascade;
drop table if exists TYPEDEGUSTATION cascade;
drop index if exists PROPOSE_1_FK cascade;
drop index if exists VISITE_PK cascade;
drop table if exists VISITE cascade;
drop view if exists v_descriptioncommande cascade;
drop view if exists v_descriptionpanier cascade;
drop view if exists v_commande cascade;
drop view if exists v_etatcommande_sejour cascade;
drop view if exists v_nbsejour_vendu cascade;
drop view if exists v_nbsejour_vendu_vignoble cascade;
drop view if exists v_datecommande cascade;
drop view if exists v_etatcommande_sejour_localite cascade;

/*==============================================================*/
/* Table : ACTIVITE                                             */
/*==============================================================*/
create table ACTIVITE 
(
   IDACTIVITE           serial                        not null,
   LIBELLEACTIVITE      varchar(100)                   not null,
   PRIXACTIVITE         numeric(8,2)                   null,
   constraint PK_ACTIVITE primary key (IDACTIVITE)
);

/*==============================================================*/
/* Index : ACTIVITE_PK                                          */
/*==============================================================*/
create unique index ACTIVITE_PK on ACTIVITE (
IDACTIVITE ASC
);

/*==============================================================*/
/* Table : ADRESSE                                              */
/*==============================================================*/
create table ADRESSE 
(
   IDADRESSE            serial                        not null,
   IDCLIENT             integer                        null,
   IDPARTENAIRE         integer                        null,
   NOMADRESSE           varchar(50)                    null,
   PRENOMADRESSEDESTINATAIRE varchar(50)                    null,
   NOMADRESSEDESTINATAIRE varchar(50)                    null,
   RUEADRESSE           varchar(100)                   not null,
   VILLEADRESSE         varchar(50)                    not null,
   PAYSADRESSE          varchar(50)    default 'France'                null,
   CPADRESSE            char(5)                        not null,
   constraint PK_ADRESSE primary key (IDADRESSE)
);

/*==============================================================*/
/* Index : ADRESSE_PK                                           */
/*==============================================================*/
create unique index ADRESSE_PK on ADRESSE (
IDADRESSE ASC
);

/*==============================================================*/
/* Index : LOCALISE_FK                                          */
/*==============================================================*/
create index LOCALISE_FK on ADRESSE (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Index : A_ENREGISTRE_FK                                      */
/*==============================================================*/
create index A_ENREGISTRE_FK on ADRESSE (
IDCLIENT ASC
);

/*==============================================================*/
/* Table : APPARTIENT_1                                         */
/*==============================================================*/
create table APPARTIENT_1 
(
   IDETAPE              integer                        not null,
   IDVISITE             integer                        not null,
   constraint PK_APPARTIENT_1 primary key (IDETAPE, IDVISITE)
);

/*==============================================================*/
/* Index : APPARTIENT_1_PK                                      */
/*==============================================================*/
create unique index APPARTIENT_1_PK on APPARTIENT_1 (
IDETAPE ASC,
IDVISITE ASC
);

/*==============================================================*/
/* Index : APPARTIENT_1_FK                                      */
/*==============================================================*/
create index APPARTIENT_1_FK on APPARTIENT_1 (
IDETAPE ASC
);

/*==============================================================*/
/* Index : APPARTIENT_5_FK                                      */
/*==============================================================*/
create index APPARTIENT_5_FK on APPARTIENT_1 (
IDVISITE ASC
);

/*==============================================================*/
/* Table : APPARTIENT_2                                         */
/*==============================================================*/
create table APPARTIENT_2 
(
   IDETAPE              integer                        not null,
   IDREPAS              integer                        not null,
   constraint PK_APPARTIENT_2 primary key  (IDETAPE, IDREPAS)
);

/*==============================================================*/
/* Index : APPARTIENT_2_PK                                      */
/*==============================================================*/
create unique  index APPARTIENT_2_PK on APPARTIENT_2 (
IDETAPE ASC,
IDREPAS ASC
);

/*==============================================================*/
/* Index : APPARTIENT_2_FK                                      */
/*==============================================================*/
create index APPARTIENT_2_FK on APPARTIENT_2 (
IDETAPE ASC
);

/*==============================================================*/
/* Index : APPARTIENT_4_FK                                      */
/*==============================================================*/
create index APPARTIENT_4_FK on APPARTIENT_2 (
IDREPAS ASC
);

/*==============================================================*/
/* Table : APPARTIENT_4                                         */
/*==============================================================*/
create table APPARTIENT_4 
(
   IDETAPE              integer                        not null,
   IDACTIVITE           integer                        not null,
   constraint PK_APPARTIENT_4 primary key  (IDETAPE, IDACTIVITE)
);

/*==============================================================*/
/* Index : APPARTIENT_4_PK                                      */
/*==============================================================*/
create unique  index APPARTIENT_4_PK on APPARTIENT_4 (
IDETAPE ASC,
IDACTIVITE ASC
);

/*==============================================================*/
/* Index : APPARTIENT_6_FK                                      */
/*==============================================================*/
create index APPARTIENT_6_FK on APPARTIENT_4 (
IDETAPE ASC
);

/*==============================================================*/
/* Index : APPARTIENT_7_FK                                      */
/*==============================================================*/
create index APPARTIENT_7_FK on APPARTIENT_4 (
IDACTIVITE ASC
);

/*==============================================================*/
/* Table : ASSOCIATION_38                                       */
/*==============================================================*/
create table ASSOCIATION_38 
(
   IDACTIVITE           integer                        not null,
   IDDESCRIPTIONPANIER  integer                        not null,
   constraint PK_ASSOCIATION_38 primary key  (IDACTIVITE, IDDESCRIPTIONPANIER)
);

/*==============================================================*/
/* Index : ASSOCIATION_38_PK                                    */
/*==============================================================*/
create unique  index ASSOCIATION_38_PK on ASSOCIATION_38 (
IDACTIVITE ASC,
IDDESCRIPTIONPANIER ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_38_FK                                    */
/*==============================================================*/
create index ASSOCIATION_38_FK on ASSOCIATION_38 (
IDACTIVITE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_39_FK                                    */
/*==============================================================*/
create index ASSOCIATION_39_FK on ASSOCIATION_38 (
IDDESCRIPTIONPANIER ASC
);

/*==============================================================*/
/* Table : ASSOCIATION_39                                       */
/*==============================================================*/
create table ASSOCIATION_39 
(
   IDREPAS              integer                        not null,
   IDDESCRIPTIONPANIER  integer                        not null,
   constraint PK_ASSOCIATION_39 primary key  (IDREPAS, IDDESCRIPTIONPANIER)
);

/*==============================================================*/
/* Index : ASSOCIATION_39_PK                                    */
/*==============================================================*/
create unique  index ASSOCIATION_39_PK on ASSOCIATION_39 (
IDREPAS ASC,
IDDESCRIPTIONPANIER ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_40_FK                                    */
/*==============================================================*/
create index ASSOCIATION_40_FK on ASSOCIATION_39 (
IDREPAS ASC
);

/*==============================================================*/
/* Index : mange1_FK                                    */
/*==============================================================*/
create index mange1_FK on ASSOCIATION_39 (
IDDESCRIPTIONPANIER ASC
);

/*==============================================================*/
/* Table : ASSOCIATION_40                                       */
/*==============================================================*/
create table ASSOCIATION_40 
(
   IDDESCRIPTIONCOMMANDE integer                        not null,
   IDACTIVITE           integer                        not null,
   constraint PK_ASSOCIATION_40 primary key  (IDDESCRIPTIONCOMMANDE, IDACTIVITE)
);

/*==============================================================*/
/* Index : ASSOCIATION_40_PK                                    */
/*==============================================================*/
create unique  index ASSOCIATION_40_PK on ASSOCIATION_40 (
IDDESCRIPTIONCOMMANDE ASC,
IDACTIVITE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_45_FK                                    */
/*==============================================================*/
create index ASSOCIATION_45_FK on ASSOCIATION_40 (
IDDESCRIPTIONCOMMANDE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_46_FK                                    */
/*==============================================================*/
create index ASSOCIATION_46_FK on ASSOCIATION_40 (
IDACTIVITE ASC
);

/*==============================================================*/
/* Table : mange1                                       */
/*==============================================================*/
create table mange1 
(
   IDDESCRIPTIONCOMMANDE integer                        not null,
   IDREPAS              integer                        not null,
   constraint PK_mange1 primary key  (IDDESCRIPTIONCOMMANDE, IDREPAS)
);

/*==============================================================*/
/* Index : mange1_PK                                    */
/*==============================================================*/
create unique  index mange1_PK on mange1 (
IDDESCRIPTIONCOMMANDE ASC,
IDREPAS ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_47_FK                                    */
/*==============================================================*/
create index ASSOCIATION_47_FK on mange1 (
IDDESCRIPTIONCOMMANDE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_48_FK                                    */
/*==============================================================*/
create index ASSOCIATION_48_FK on mange1 (
IDREPAS ASC
);

/*==============================================================*/
/* Table : AUTRESOCIETE                                         */
/*==============================================================*/
create table AUTRESOCIETE 
(
   IDPARTENAIRE         integer                        not null,
   NOMPARTENAIRE        varchar(50)                    not null,
   MAILPARTENAIRE       varchar(100)                   not null,
   TELPARTENAIRE        char(10)                       not null,
   constraint PK_AUTRESOCIETE primary key  (IDPARTENAIRE)
);

/*==============================================================*/
/* Index : AUTRESOCIETE_PK                                      */
/*==============================================================*/
create unique  index AUTRESOCIETE_PK on AUTRESOCIETE (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Table : AVIS                                                 */
/*==============================================================*/
create table AVIS 
(
   IDAVIS               serial                        not null,
   IDCLIENT             integer                        not null,
   IDSEJOUR             integer                        not null,
   TITREAVIS            varchar(50)                    not null,
   DATEAVIS             timestamp                      not null,
   DESCRIPTIONAVIS      varchar(2048)                  not null,
   NOTEAVIS             integer                        not null,
   constraint PK_AVIS primary key (IDAVIS)
);

/*==============================================================*/
/* Index : AVIS_PK                                              */
/*==============================================================*/
create unique index AVIS_PK on AVIS (
IDAVIS ASC
);

/*==============================================================*/
/* Index : CRITIQUE_FK                                          */
/*==============================================================*/
create index CRITIQUE_FK on AVIS (
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : POSTE_FK                                             */
/*==============================================================*/
create index POSTE_FK on AVIS (
IDCLIENT ASC
);

/*==============================================================*/
/* Table : CARTE_BANCAIRE                                       */
/*==============================================================*/
create table CARTE_BANCAIRE 
(
   IDcb                 serial                        not null,
   IDCLIENT             integer                        not null,
   TITULAIREcb          varchar(100)                   null,
   NUMEROcbCLIENT       char(16)                       null,
   DATEEXPIRATIONcbCLIENT date                           null,
   ACTIF				bool		default true					not null,
   constraint PK_CARTE_BANCAIRE primary key (IDcb)
);

/*==============================================================*/
/* Index : CARTE_BANCAIRE_PK                                    */
/*==============================================================*/
create unique index CARTE_BANCAIRE_PK on CARTE_BANCAIRE (
IDcb ASC
);

/*==============================================================*/
/* Index : DETIENT_FK                                           */
/*==============================================================*/
create index DETIENT_FK on CARTE_BANCAIRE (
IDCLIENT ASC
);

/*==============================================================*/
/* Table : CATEGORIEPARTICIPANT                                 */
/*==============================================================*/
create table CATEGORIEPARTICIPANT 
(
   IDCATEGORIEPARTICIPANT serial                        not null,
   LIBELLECATEGORIEPARTICIPANT varchar(50)                    not null,
   constraint PK_CATEGORIEPARTICIPANT primary key (IDCATEGORIEPARTICIPANT)
);

/*==============================================================*/
/* Index : CATEGORIEPARTICIPANT_PK                              */
/*==============================================================*/
create unique index CATEGORIEPARTICIPANT_PK on CATEGORIEPARTICIPANT (
IDCATEGORIEPARTICIPANT ASC
);

/*==============================================================*/
/* Table : CATEGORIESEJOUR                                      */
/*==============================================================*/
create table CATEGORIESEJOUR 
(
   IDCATEGORIESEJOUR    serial                        not null,
   LIBELLECATEGORIESEJOUR varchar(50)                    null,
   constraint PK_CATEGORIESEJOUR primary key (IDCATEGORIESEJOUR)
);

/*==============================================================*/
/* Index : CATEGORIESEJOUR_PK                                   */
/*==============================================================*/
create unique index CATEGORIESEJOUR_PK on CATEGORIESEJOUR (
IDCATEGORIESEJOUR ASC
);

/*==============================================================*/
/* Table : CATEGORIEVIGNOBLE                                    */
/*==============================================================*/
create table CATEGORIEVIGNOBLE 
(
   IDCATEGORIEVIGNOBLE  serial                        not null,
   LIBELLECATEGORIEVIGNOBLE varchar(50)                    not null,
   constraint PK_CATEGORIEVIGNOBLE primary key (IDCATEGORIEVIGNOBLE)
);

/*==============================================================*/
/* Index : CATEGORIEVIGNOBLE_PK                                 */
/*==============================================================*/
create unique index CATEGORIEVIGNOBLE_PK on CATEGORIEVIGNOBLE (
IDCATEGORIEVIGNOBLE ASC
);

/*==============================================================*/
/* Table : CAVE                                                 */
/*==============================================================*/
create table CAVE 
(
   IDPARTENAIRE         integer                        not null,
   IDTYPEDEGUSTATION    integer                        not null,
   NOMPARTENAIRE        varchar(50)                    not null,
   MAILPARTENAIRE       varchar(100)                   not null,
   TELPARTENAIRE        char(10)                       not null,
   constraint PK_CAVE primary key  (IDPARTENAIRE)
);

/*==============================================================*/
/* Index : CAVE_PK                                              */
/*==============================================================*/
create unique  index CAVE_PK on CAVE (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Index : FAIT_DEGUSTER_FK                                     */
/*==============================================================*/
create index FAIT_DEGUSTER_FK on CAVE (
IDTYPEDEGUSTATION ASC
);

/*==============================================================*/
/* Table : CHATBOT                                              */
/*==============================================================*/
create table CHATBOT 
(
   IDCHAT               serial                        not null,
   MESSAGECHAT          varchar(500)                   null,
   constraint PK_CHATBOT primary key (IDCHAT)
);

/*==============================================================*/
/* Index : CHATBOT_PK                                           */
/*==============================================================*/
create unique index CHATBOT_PK on CHATBOT (
IDCHAT ASC
);

/*==============================================================*/
/* Table : CLIENT                                               */
/*==============================================================*/
create table CLIENT 
(
   IDCLIENT             serial                        not null,
   IDROLE               integer                        not null,
   CIVILITECLIENT       varchar(10)                    null,
   PRENOMCLIENT         varchar(50)                    not null,
   NOMCLIENT            varchar(50)                    not null,
   EMAILCLIENT          varchar(150)                   not null,
   DATENAISSANCECLIENT  date                           null,
   MOTDEPASSECLIENT     varchar(512)                   not null,
   OFFRESPROMOTIONNELLESCLIENT bool                       not null,
   DATEDERNIEREACTIVITECLIENT date                           null,
   TELEPHONECLIENT		char(10)						not null,
   TOKENRESETMDP		char(60)	default null		null,
   DATECREATIONTOKEN	timestamp	default null		null,
   constraint PK_CLIENT primary key (IDCLIENT)
);

/*==============================================================*/
/* Index : CLIENT_PK                                            */
/*==============================================================*/
create unique index CLIENT_PK on CLIENT (
IDCLIENT ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_43_FK                                    */
/*==============================================================*/
create index ASSOCIATION_43_FK on CLIENT (
IDROLE ASC
);

/*==============================================================*/
/* Table : COMMANDE                                             */
/*==============================================================*/
create table COMMANDE 
(
   IDCOMMANDE           serial                        not null,
   IDcb                 integer                        null,
   IDCLIENTACHETEUR             integer                        not null,
   IDCLIENTBENEFICIAIRE         integer                        null,
   IDADRESSELIVRAISON            integer                        null,
   IDPANIER             integer                        not null,
   IDADRESSEFACTURATION        integer                        not null,
   CODEREDUCTION        varchar(20)                     null,
   ETATCOMMANDE         varchar(50)       default 'En attente de validation'            null,
   TYPEPAIEMENTCOMMANDE varchar(50)                    null,
   DATECOMMANDE          date         default '2025-01-01'                 not null,
   constraint PK_COMMANDE primary key (IDCOMMANDE)
);

/*==============================================================*/
/* Index : COMMANDE_PK                                          */
/*==============================================================*/
create unique index COMMANDE_PK on COMMANDE (
IDCOMMANDE ASC
);

/*==============================================================*/
/* Index : REALISE_FK                                           */
/*==============================================================*/
create index REALISE_FK on COMMANDE (
IDCLIENTBENEFICIAIRE ASC
);

/*==============================================================*/
/* Index : FACTUREA_FK                                          */
/*==============================================================*/
create index FACTUREA_FK on COMMANDE (
IDADRESSEFACTURATION ASC
);

/*==============================================================*/
/* Index : LIVREA_FK                                            */
/*==============================================================*/
create index LIVREA_FK on COMMANDE (
IDADRESSELIVRAISON ASC
);

/*==============================================================*/
/* Index : ASSOCIE2_FK                                          */
/*==============================================================*/
create index ASSOCIE2_FK on COMMANDE (
IDPANIER ASC
);

/*==============================================================*/
/* Index : BENEFICIAIRE_FK                                      */
/*==============================================================*/
create index BENEFICIAIRE_FK on COMMANDE (
IDCLIENTACHETEUR ASC
);

/*==============================================================*/
/* Table : DESCRIPTIONCOMMANDE                                  */
/*==============================================================*/
create table DESCRIPTIONCOMMANDE 
(
   IDDESCRIPTIONCOMMANDE serial                        not null,
   IDHEBERGEMENT        integer                        not null,
   IDSEJOUR             integer                        not null,
   IDCOMMANDE           integer                        not null,
   QUANTITE             integer                        null,
   DATEDEBUT            date                           null,
   DATEFIN              date                           null,
   NBADULTES            integer                        null,
   NBENFANTS            integer                        null,
   NBCHAMBRESSIMPLE     integer                        null,
   NBCHAMBRESDOUBLE     integer                        null,
   NBCHAMBRESTRIPLE     integer                        null,
   OFFRIR               bool                       null,
   ECOFFRET             bool                       null,
   DISPONIBILITEHEBERGEMENT bool                       null,
   VALIDATIONCLIENT     bool      default false                 null,
   CODEPROMOUTILISE     varchar(20)                    null default null,
   constraint PK_DESCRIPTIONCOMMANDE primary key (IDDESCRIPTIONCOMMANDE)
);

/*==============================================================*/
/* Index : DESCRIPTIONCOMMANDE_PK                               */
/*==============================================================*/
create unique index DESCRIPTIONCOMMANDE_PK on DESCRIPTIONCOMMANDE (
IDDESCRIPTIONCOMMANDE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_35_FK                                    */
/*==============================================================*/
create index ASSOCIATION_35_FK on DESCRIPTIONCOMMANDE (
IDCOMMANDE ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_36_FK                                    */
/*==============================================================*/
create index ASSOCIATION_36_FK on DESCRIPTIONCOMMANDE (
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_41_FK                                    */
/*==============================================================*/
create index ASSOCIATION_41_FK on DESCRIPTIONCOMMANDE (
IDHEBERGEMENT ASC
);

/*==============================================================*/
/* Table : DESCRIPTIONPANIER                                    */
/*==============================================================*/
create table DESCRIPTIONPANIER 
(
   IDDESCRIPTIONPANIER  serial                        not null,
   IDPANIER             integer                        not null,
   IDSEJOUR             integer                        not null,
   IDHEBERGEMENT        integer                        not null,
   QUANTITE             integer                        null,
   DATEDEBUT            date                           null,
   DATEFIN              date                           null,
   NBADULTES            integer                        null,
   NBENFANTS            integer                        null,
   NBCHAMBRESSIMPLE     integer                        null,
   NBCHAMBRESDOUBLE     integer                        null,
   NBCHAMBRESTRIPLE     integer                        null,
   OFFRIR               bool                       null,
   ECOFFRET             bool                       null,
   DISPONIBILITEHEBERGEMENT bool                       null,
   CODEPROMOUTILISE     varchar(20)                    null default null,
   constraint PK_DESCRIPTIONPANIER primary key (IDDESCRIPTIONPANIER)
);

/*==============================================================*/
/* Index : DESCRIPTIONPANIER_PK                                 */
/*==============================================================*/
create unique index DESCRIPTIONPANIER_PK on DESCRIPTIONPANIER (
IDDESCRIPTIONPANIER ASC
);

/*==============================================================*/
/* Index : DECRIT_SEJOUR_PANIER_FK                              */
/*==============================================================*/
create index DECRIT_SEJOUR_PANIER_FK on DESCRIPTIONPANIER (
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : DECRIT_PANIER_FK                                     */
/*==============================================================*/
create index DECRIT_PANIER_FK on DESCRIPTIONPANIER (
IDPANIER ASC
);

/*==============================================================*/
/* Index : ASSOCIATION_37_FK                                    */
/*==============================================================*/
create index ASSOCIATION_37_FK on DESCRIPTIONPANIER (
IDHEBERGEMENT ASC
);

/*==============================================================*/
/* Table : DUREE                                                */
/*==============================================================*/
create table DUREE 
(
   IDDUREE              serial                        not null,
   LIBELLEDUREE         varchar(50)                    not null,
   constraint PK_DUREE primary key (IDDUREE)
);

/*==============================================================*/
/* Index : DUREE_PK                                             */
/*==============================================================*/
create unique index DUREE_PK on DUREE (
IDDUREE ASC
);

/*==============================================================*/
/* Table : ETAPE                                                */
/*==============================================================*/
create table ETAPE 
(
   IDETAPE              serial                        not null,
   IDHEBERGEMENT        integer                        not null,
   IDSEJOUR             integer                        not null,
   TITREETAPE           varchar(100)                   not null,
   DESCRIPTIONETAPE     varchar(4096)                  null,
   PHOTOETAPE           varchar(512)                   null,
   URLETAPE             varchar(150)                   null,
   VIDEOETAPE           varchar(512)                   null,
   constraint PK_ETAPE primary key (IDETAPE)
);

/*==============================================================*/
/* Index : ETAPE_PK                                             */
/*==============================================================*/
create unique index ETAPE_PK on ETAPE (
IDETAPE ASC
);

/*==============================================================*/
/* Index : POSSEDE_FK                                           */
/*==============================================================*/
create index POSSEDE_FK on ETAPE (
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : APPARTIENT_3_FK                                      */
/*==============================================================*/
create index APPARTIENT_3_FK on ETAPE (
IDHEBERGEMENT ASC
);

/*==============================================================*/
/* Table : FAVORIS                                              */
/*==============================================================*/
create table FAVORIS 
(
   IDCLIENT             integer                        not null,
   IDSEJOUR             integer                        not null,
   constraint PK_FAVORIS primary key  (IDCLIENT, IDSEJOUR)
);

/*==============================================================*/
/* Index : FAVORIS_PK                                           */
/*==============================================================*/
create unique  index FAVORIS_PK on FAVORIS (
IDCLIENT ASC,
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : FAVORIS_FK                                           */
/*==============================================================*/
create index FAVORIS_FK on FAVORIS (
IDCLIENT ASC
);

/*==============================================================*/
/* Index : FAVORIS2_FK                                          */
/*==============================================================*/
create index FAVORIS2_FK on FAVORIS (
IDSEJOUR ASC
);

/*==============================================================*/
/* Table : HEBERGEMENT                                          */
/*==============================================================*/
create table HEBERGEMENT 
(
   IDHEBERGEMENT        serial                        not null,
   IDPARTENAIRE         integer                        not null,
   DESCRIPTIONHEBERGEMENT varchar(4096)                  not null,
   PHOTOHEBERGEMENT     varchar(512)                   null,
   LIENHEBERGEMENT      varchar(512)                   null,
   PRIXHEBERGEMENT      numeric(8,2)                   null,
   constraint PK_HEBERGEMENT primary key (IDHEBERGEMENT)
);

/*==============================================================*/
/* Index : HEBERGEMENT_PK                                       */
/*==============================================================*/
create unique index HEBERGEMENT_PK on HEBERGEMENT (
IDHEBERGEMENT ASC
);

/*==============================================================*/
/* Index : PROPOSE_3_FK                                         */
/*==============================================================*/
create index PROPOSE_3_FK on HEBERGEMENT (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Table : HOTEL                                                */
/*==============================================================*/
create table HOTEL 
(
   IDPARTENAIRE         integer                        not null,
   NOMPARTENAIRE        varchar(50)                    not null,
   MAILPARTENAIRE       varchar(100)                   not null,
   TELPARTENAIRE        char(10)                       not null,
   NOMBRECHAMBRESHOTEL  integer                        not null,
   CATEGORIEHOTEL       integer                        not null,
   constraint PK_HOTEL primary key  (IDPARTENAIRE)
);

/*==============================================================*/
/* Index : HOTEL_PK                                             */
/*==============================================================*/
create unique  index HOTEL_PK on HOTEL (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Table : LOCALITE                                             */
/*==============================================================*/
create table LOCALITE 
(
   IDLOCALITE           serial                        not null,
   IDCATEGORIEVIGNOBLE  integer                        not null,
   LIBELLELOCALITE      varchar(50)                    not null,
   constraint PK_LOCALITE primary key (IDLOCALITE)
);

/*==============================================================*/
/* Index : LOCALITE_PK                                          */
/*==============================================================*/
create unique index LOCALITE_PK on LOCALITE (
IDLOCALITE ASC
);

/*==============================================================*/
/* Index : A_FK                                                 */
/*==============================================================*/
create index A_FK on LOCALITE (
IDCATEGORIEVIGNOBLE ASC
);

/*==============================================================*/
/* Table : PANIER                                               */
/*==============================================================*/
create table PANIER 
(
   IDPANIER             serial                        not null,
   DATEHEUREPANIER      timestamp   				  not null,
   constraint PK_PANIER primary key (IDPANIER)
);

/*==============================================================*/
/* Index : PANIER_PK                                            */
/*==============================================================*/
create unique index PANIER_PK on PANIER (
IDPANIER ASC
);

/*==============================================================*/
/* Table : PARTENAIRE                                           */
/*==============================================================*/
create table PARTENAIRE 
(
   IDPARTENAIRE         serial                        not null,
   NOMPARTENAIRE        varchar(50)                    not null,
   MAILPARTENAIRE       varchar(100)                   not null,
   TELPARTENAIRE        char(10)                       not null,
   constraint PK_PARTENAIRE primary key (IDPARTENAIRE)
);

/*==============================================================*/
/* Index : PARTENAIRE_PK                                        */
/*==============================================================*/
create unique index PARTENAIRE_PK on PARTENAIRE (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Table : PROPOSE_4                                            */
/*==============================================================*/
create table PROPOSE_4 
(
   IDACTIVITE           integer                        not null,
   IDPARTENAIRE         integer                        not null,
   IDADRESSE            integer                        not null,
   constraint PK_PROPOSE_4 primary key  (IDACTIVITE, IDPARTENAIRE, IDADRESSE)
);

/*==============================================================*/
/* Index : PROPOSE_4_PK                                         */
/*==============================================================*/
create unique  index PROPOSE_4_PK on PROPOSE_4 (
IDACTIVITE ASC,
IDPARTENAIRE ASC,
IDADRESSE ASC
);

/*==============================================================*/
/* Index : PROPOSE_4_FK                                         */
/*==============================================================*/
create index PROPOSE_4_FK on PROPOSE_4 (
IDACTIVITE ASC
);

/*==============================================================*/
/* Index : PROPOSE_5_FK                                         */
/*==============================================================*/
create index PROPOSE_5_FK on PROPOSE_4 (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Index : PROPOSE_6_FK                                         */
/*==============================================================*/
create index PROPOSE_6_FK on PROPOSE_4 (
IDADRESSE ASC
);

/*==============================================================*/
/* Table : REPAS                                                */
/*==============================================================*/
create table REPAS 
(
   IDREPAS              serial                        not null,
   IDPARTENAIRE         integer                        not null,
   DESCRIPTIONREPAS     varchar(4096)                  not null,
   PHOTOREPAS           varchar(512)                   null,
   PRIXREPAS            numeric(8,2)                   null,
   constraint PK_REPAS primary key (IDREPAS)
);

/*==============================================================*/
/* Index : REPAS_PK                                             */
/*==============================================================*/
create unique index REPAS_PK on REPAS (
IDREPAS ASC
);

/*==============================================================*/
/* Index : PROPOSE_2_FK                                         */
/*==============================================================*/
create index PROPOSE_2_FK on REPAS (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Table : RESTAURANT                                           */
/*==============================================================*/
create table RESTAURANT 
(
   IDPARTENAIRE         integer                        not null,
   IDTYPECUISINE        integer                        not null,
   NOMPARTENAIRE        varchar(50)                    not null,
   MAILPARTENAIRE       varchar(100)                   not null,
   TELPARTENAIRE        char(10)                       not null,
   NOMBREETOILESRESTAURANT integer                        not null,
   SPECIALITERESTAURANT varchar(50)                    null,
   constraint PK_RESTAURANT primary key  (IDPARTENAIRE)
);

/*==============================================================*/
/* Index : RESTAURANT_PK                                        */
/*==============================================================*/
create unique  index RESTAURANT_PK on RESTAURANT (
IDPARTENAIRE ASC
);

/*==============================================================*/
/* Index : CUISINE_FK                                           */
/*==============================================================*/
create index CUISINE_FK on RESTAURANT (
IDTYPECUISINE ASC
);

/*==============================================================*/
/* Table : ROLES                                                */
/*==============================================================*/
create table ROLES 
(
   IDROLE               serial                        not null,
   LIBELLEROLE          varchar(50)                    null,
   constraint PK_ROLES primary key (IDROLE)
);

/*==============================================================*/
/* Index : ROLES_PK                                             */
/*==============================================================*/
create unique index ROLES_PK on ROLES (
IDROLE ASC
);

/*==============================================================*/
/* Table : ROUTE_DES_VINS                                       */
/*==============================================================*/
create table ROUTE_DES_VINS 
(
   IDROUTE              serial                        not null,
   TITREROUTE           varchar(120)                   null,
   DESCRIPTIONROUTE     varchar(2048)                  null,
   PHOTOROUTE           varchar(512)                   null,
   constraint PK_ROUTE_DES_VINS primary key (IDROUTE)
);

/*==============================================================*/
/* Index : ROUTE_DES_VINS_PK                                    */
/*==============================================================*/
create unique index ROUTE_DES_VINS_PK on ROUTE_DES_VINS (
IDROUTE ASC
);

/*==============================================================*/
/* Table : SEJOUR                                               */
/*==============================================================*/
create table SEJOUR 
(
   IDSEJOUR             serial                        not null,
   IDCATEGORIESEJOUR    integer                        not null,
   IDDUREE              integer                        not null,
   IDTHEME              integer                        not null,
   IDCATEGORIEVIGNOBLE  integer                        not null,
   IDCATEGORIEPARTICIPANT integer                        not null,
   IDLOCALITE           integer                        null,
   TITRESEJOUR          varchar(100)                   not null,
   PHOTOSEJOUR          varchar(512)                   null,
   DESCRIPTIONSEJOUR    varchar(4096)                  null,
   PRIXSEJOUR           numeric(8,2)                   null,
   NOUVEAUPRIXSEJOUR	numeric(8,2)			null,
   PUBLIE               boolean                        not null default false,
   constraint PK_SEJOUR primary key (IDSEJOUR)
);

/*==============================================================*/
/* Index : SEJOUR_PK                                            */
/*==============================================================*/
create unique index SEJOUR_PK on SEJOUR (
IDSEJOUR ASC
);

/*==============================================================*/
/* Index : CATEGORISE_FK                                        */
/*==============================================================*/
create index CATEGORISE_FK on SEJOUR (
IDCATEGORIEVIGNOBLE ASC
);

/*==============================================================*/
/* Index : DEFINIT_FK                                           */
/*==============================================================*/
create index DEFINIT_FK on SEJOUR (
IDTHEME ASC
);

/*==============================================================*/
/* Index : DESTINE_A_FK                                         */
/*==============================================================*/
create index DESTINE_A_FK on SEJOUR (
IDCATEGORIEPARTICIPANT ASC
);

/*==============================================================*/
/* Index : REGROUPE_FK                                          */
/*==============================================================*/
create index REGROUPE_FK on SEJOUR (
IDCATEGORIESEJOUR ASC
);

/*==============================================================*/
/* Index : DURE_FK                                              */
/*==============================================================*/
create index DURE_FK on SEJOUR (
IDDUREE ASC
);

/*==============================================================*/
/* Table : SE_LOCALISE                                          */
/*==============================================================*/
create table SE_LOCALISE 
(
   IDROUTE              integer                        not null,
   IDCATEGORIEVIGNOBLE  integer                        not null,
   constraint PK_SE_LOCALISE primary key  (IDROUTE, IDCATEGORIEVIGNOBLE)
);

/*==============================================================*/
/* Index : SE_LOCALISE_PK                                       */
/*==============================================================*/
create unique  index SE_LOCALISE_PK on SE_LOCALISE (
IDROUTE ASC,
IDCATEGORIEVIGNOBLE ASC
);

/*==============================================================*/
/* Index : SE_LOCALISE_FK                                       */
/*==============================================================*/
create index SE_LOCALISE_FK on SE_LOCALISE (
IDROUTE ASC
);

/*==============================================================*/
/* Index : SE_LOCALISE2_FK                                      */
/*==============================================================*/
create index SE_LOCALISE2_FK on SE_LOCALISE (
IDCATEGORIEVIGNOBLE ASC
);

/*==============================================================*/
/* Table : THEME                                                */
/*==============================================================*/
create table THEME 
(
   IDTHEME              serial                        not null,
   LIBELLETHEME         varchar(50)                    not null,
   constraint PK_THEME primary key (IDTHEME)
);

/*==============================================================*/
/* Index : THEME_PK                                             */
/*==============================================================*/
create unique index THEME_PK on THEME (
IDTHEME ASC
);

/*==============================================================*/
/* Table : TYPECUISINE                                          */
/*==============================================================*/
create table TYPECUISINE 
(
   IDTYPECUISINE        serial                        not null,
   LIBELLETYPECUISINE  varchar(50)                    not null,
   constraint PK_TYPECUISINE primary key (IDTYPECUISINE)
);

/*==============================================================*/
/* Index : TYPECUISINE_PK                                       */
/*==============================================================*/
create unique index TYPECUISINE_PK on TYPECUISINE (
IDTYPECUISINE ASC
);

/*==============================================================*/
/* Table : TYPEDEGUSTATION                                      */
/*==============================================================*/
create table TYPEDEGUSTATION 
(
   IDTYPEDEGUSTATION    serial                        not null,
   LIBELLETYPEDEGUSTATION varchar(50)                    not null,
   constraint PK_TYPEDEGUSTATION primary key (IDTYPEDEGUSTATION)
);

/*==============================================================*/
/* Index : TYPEDEGUSTATION_PK                                   */
/*==============================================================*/
create unique index TYPEDEGUSTATION_PK on TYPEDEGUSTATION (
IDTYPEDEGUSTATION ASC
);

/*==============================================================*/
/* Table : VISITE                                               */
/*==============================================================*/
create table VISITE 
(
   IDVISITE             serial                        not null,
   IDPARTENAIRE         integer                        not null,
   DESCRIPTIONVISITE    varchar(4096)                  not null,
   PHOTOVISITE          varchar(512)                   null,
   LIENVISITE           varchar(512)                   null,
   constraint PK_VISITE primary key (IDVISITE)
);

/*==============================================================*/
/* Index : VISITE_PK                                            */
/*==============================================================*/
create unique index VISITE_PK on VISITE (
IDVISITE ASC
);

/*==============================================================*/
/* Index : PROPOSE_1_FK                                         */
/*==============================================================*/
create index PROPOSE_1_FK on VISITE (
IDPARTENAIRE ASC
);

alter table ADRESSE
   add constraint FK_ADRESSE_A_ENREGIS_CLIENT foreign key (IDCLIENT)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table ADRESSE
   add constraint FK_ADRESSE_LOCALISE_PARTENAI foreign key (IDPARTENAIRE)
      references PARTENAIRE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table APPARTIENT_1
   add constraint FK_APPARTIE_APPARTIEN_ETAPE foreign key (IDETAPE)
      references ETAPE (IDETAPE)
      on update restrict
      on delete restrict;

alter table APPARTIENT_1
   add constraint FK_APPARTIE_APPARTIEN_VISITE foreign key (IDVISITE)
      references VISITE (IDVISITE)
      on update restrict
      on delete restrict;

alter table APPARTIENT_2
   add constraint FK_APPARTIE_APPARTIEN_ETAPE foreign key (IDETAPE)
      references ETAPE (IDETAPE)
      on update restrict
      on delete restrict;

alter table APPARTIENT_2
   add constraint FK_APPARTIE_APPARTIEN_REPAS foreign key (IDREPAS)
      references REPAS (IDREPAS)
      on update restrict
      on delete restrict;

alter table APPARTIENT_4
   add constraint FK_APPARTIE_APPARTIEN_ETAPE foreign key (IDETAPE)
      references ETAPE (IDETAPE)
      on update restrict
      on delete restrict;

alter table APPARTIENT_4
   add constraint FK_APPARTIE_APPARTIEN_ACTIVITE foreign key (IDACTIVITE)
      references ACTIVITE (IDACTIVITE)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_38
   add constraint FK_ASSOCIAT_ASSOCIATI_ACTIVITE foreign key (IDACTIVITE)
      references ACTIVITE (IDACTIVITE)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_38
   add constraint FK_ASSOCIAT_ASSOCIATI_DESCRIPT foreign key (IDDESCRIPTIONPANIER)
      references DESCRIPTIONPANIER (IDDESCRIPTIONPANIER)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_39
   add constraint FK_ASSOCIAT_ASSOCIATI_REPAS foreign key (IDREPAS)
      references REPAS (IDREPAS)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_39
   add constraint FK_ASSOCIAT_ASSOCIATI_DESCRIPT foreign key (IDDESCRIPTIONPANIER)
      references DESCRIPTIONPANIER (IDDESCRIPTIONPANIER)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_40
   add constraint FK_ASSOCIAT_ASSOCIATI_DESCRIPT foreign key (IDDESCRIPTIONCOMMANDE)
      references DESCRIPTIONCOMMANDE (IDDESCRIPTIONCOMMANDE)
      on update restrict
      on delete restrict;

alter table ASSOCIATION_40
   add constraint FK_ASSOCIAT_ASSOCIATI_ACTIVITE foreign key (IDACTIVITE)
      references ACTIVITE (IDACTIVITE)
      on update restrict
      on delete restrict;

alter table mange1
   add constraint FK_ASSOCIAT_ASSOCIATI_DESCRIPT foreign key (IDDESCRIPTIONCOMMANDE)
      references DESCRIPTIONCOMMANDE (IDDESCRIPTIONCOMMANDE)
      on update restrict
      on delete restrict;

alter table mange1
   add constraint FK_ASSOCIAT_ASSOCIATI_REPAS foreign key (IDREPAS)
      references REPAS (IDREPAS)
      on update restrict
      on delete restrict;

alter table AUTRESOCIETE
   add constraint FK_AUTRESOC_HERITAGE__PARTENAI foreign key (IDPARTENAIRE)
      references PARTENAIRE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table AVIS
   add constraint FK_AVIS_CRITIQUE_SEJOUR foreign key (IDSEJOUR)
      references SEJOUR (IDSEJOUR)
      on update restrict
      on delete restrict;

alter table AVIS
   add constraint FK_AVIS_POSTE_CLIENT foreign key (IDCLIENT)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table CARTE_BANCAIRE
   add constraint FK_CARTE_BA_DETIENT_CLIENT foreign key (IDCLIENT)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table CAVE
   add constraint FK_CAVE_FAIT_DEGU_TYPEDEGU foreign key (IDTYPEDEGUSTATION)
      references TYPEDEGUSTATION (IDTYPEDEGUSTATION)
      on update restrict
      on delete restrict;

alter table CAVE
   add constraint FK_CAVE_HERITAGE__PARTENAI foreign key (IDPARTENAIRE)
      references PARTENAIRE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table CLIENT
   add constraint FK_CLIENT_ASSOCIATI_ROLES foreign key (IDROLE)
      references ROLES (IDROLE)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_ASSOCIE2_PANIER foreign key (IDPANIER)
      references PANIER (IDPANIER)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_BENEFICIA_CLIENT foreign key (IDCLIENTACHETEUR)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_FACTUREA_ADRESSE foreign key (IDADRESSEFACTURATION)
      references ADRESSE (IDADRESSE)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_LIVREA_ADRESSE foreign key (IDADRESSELIVRAISON)
      references ADRESSE (IDADRESSE)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_REALISE_CLIENT foreign key (IDCLIENTBENEFICIAIRE)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table COMMANDE
   add constraint FK_COMMANDE_cb foreign key (IDcb)
      references CARTE_BANCAIRE (IDcb)
      on update restrict
      on delete restrict;
	  
alter table DESCRIPTIONCOMMANDE
   add constraint FK_DESCRIPT_ASSOCIATI_COMMANDE foreign key (IDCOMMANDE)
      references COMMANDE (IDCOMMANDE)
      on update restrict
      on delete restrict;

alter table DESCRIPTIONCOMMANDE
   add constraint FK_DESCRIPT_ASSOCIATI_SEJOUR foreign key (IDSEJOUR)
      references SEJOUR (IDSEJOUR)
      on update restrict
      on delete restrict;

alter table DESCRIPTIONCOMMANDE
   add constraint FK_DESCRIPT_ASSOCIATI_HEBERGEM foreign key (IDHEBERGEMENT)
      references HEBERGEMENT (IDHEBERGEMENT)
      on update restrict
      on delete restrict;

alter table DESCRIPTIONPANIER
   add constraint FK_DESCRIPT_ASSOCIATI_HEBERGEM foreign key (IDHEBERGEMENT)
      references HEBERGEMENT (IDHEBERGEMENT)
      on update restrict
      on delete restrict;

alter table DESCRIPTIONPANIER
   add constraint FK_DESCRIPT_DECRIT_PA_PANIER foreign key (IDPANIER)
      references PANIER (IDPANIER)
      on update restrict
      on delete restrict;

alter table DESCRIPTIONPANIER
   add constraint FK_DESCRIPT_DECRIT_SE_SEJOUR foreign key (IDSEJOUR)
      references SEJOUR (IDSEJOUR)
      on update restrict
      on delete restrict;

alter table ETAPE
   add constraint FK_ETAPE_APPARTIEN_HEBERGEM foreign key (IDHEBERGEMENT)
      references HEBERGEMENT (IDHEBERGEMENT)
      on update restrict
      on delete restrict;

alter table ETAPE
   add constraint FK_ETAPE_POSSEDE_SEJOUR foreign key (IDSEJOUR)
      references SEJOUR (IDSEJOUR)
      on update restrict
      on delete restrict;

alter table FAVORIS
   add constraint FK_FAVORIS_FAVORIS_CLIENT foreign key (IDCLIENT)
      references CLIENT (IDCLIENT)
      on update restrict
      on delete restrict;

alter table FAVORIS
   add constraint FK_FAVORIS_FAVORIS2_SEJOUR foreign key (IDSEJOUR)
      references SEJOUR (IDSEJOUR)
      on update restrict
      on delete restrict;

alter table HEBERGEMENT
   add constraint FK_HEBERGEM_PROPOSE_3_HOTEL foreign key (IDPARTENAIRE)
      references HOTEL (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table HOTEL
   add constraint FK_HOTEL_HERITAGE__PARTENAI foreign key (IDPARTENAIRE)
      references PARTENAIRE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table LOCALITE
   add constraint FK_LOCALITE_A_CATEGORI foreign key (IDCATEGORIEVIGNOBLE)
      references CATEGORIEVIGNOBLE (IDCATEGORIEVIGNOBLE)
      on update restrict
      on delete restrict;

alter table PROPOSE_4
   add constraint FK_PROPOSE__PROPOSE_4_ACTIVITE foreign key (IDACTIVITE)
      references ACTIVITE (IDACTIVITE)
      on update restrict
      on delete restrict;

alter table PROPOSE_4
   add constraint FK_PROPOSE__PROPOSE_5_AUTRESOC foreign key (IDPARTENAIRE)
      references AUTRESOCIETE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table PROPOSE_4
   add constraint FK_PROPOSE__PROPOSE_6_ADRESSE foreign key (IDADRESSE)
      references ADRESSE (IDADRESSE)
      on update restrict
      on delete restrict;

alter table REPAS
   add constraint FK_REPAS_PROPOSE_2_RESTAURA foreign key (IDPARTENAIRE)
      references RESTAURANT (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table RESTAURANT
   add constraint FK_RESTAURA_CUISINE_TYPECUIS foreign key (IDTYPECUISINE)
      references TYPECUISINE (IDTYPECUISINE)
      on update restrict
      on delete restrict;

alter table RESTAURANT
   add constraint FK_RESTAURA_HERITAGE__PARTENAI foreign key (IDPARTENAIRE)
      references PARTENAIRE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_CATEGORIS_CATEGORI foreign key (IDCATEGORIEVIGNOBLE)
      references CATEGORIEVIGNOBLE (IDCATEGORIEVIGNOBLE)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_DEFINIT_THEME foreign key (IDTHEME)
      references THEME (IDTHEME)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_DESTINE_A_CATEGORI foreign key (IDCATEGORIEPARTICIPANT)
      references CATEGORIEPARTICIPANT (IDCATEGORIEPARTICIPANT)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_DURE_DUREE foreign key (IDDUREE)
      references DUREE (IDDUREE)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_REGROUPE_CATEGORI foreign key (IDCATEGORIESEJOUR)
      references CATEGORIESEJOUR (IDCATEGORIESEJOUR)
      on update restrict
      on delete restrict;

alter table SEJOUR
   add constraint FK_SEJOUR_SE_SITUE_LOCALITE foreign key (IDLOCALITE)
      references LOCALITE (IDLOCALITE)
      on update restrict
      on delete restrict;

alter table SE_LOCALISE
   add constraint FK_SE_LOCAL_SE_LOCALI_ROUTE_DE foreign key (IDROUTE)
      references ROUTE_DES_VINS (IDROUTE)
      on update restrict
      on delete restrict;

alter table SE_LOCALISE
   add constraint FK_SE_LOCAL_SE_LOCALI_CATEGORI foreign key (IDCATEGORIEVIGNOBLE)
      references CATEGORIEVIGNOBLE (IDCATEGORIEVIGNOBLE)
      on update restrict
      on delete restrict;

alter table VISITE
   add constraint FK_VISITE_PROPOSE_1_CAVE foreign key (IDPARTENAIRE)
      references CAVE (IDPARTENAIRE)
      on update restrict
      on delete restrict;

----------------------------------------------------------------------- CHECKS

alter table client
   add constraint CK_CLIENT_CIVILITE
      check (civiliteClient IN ('M', 'Mme', 'Mlle')),
   add constraint CK_CLIENT_ACTIVITE
	  check (dateDerniereActiviteClient >= CURRENT_DATE - INTERVAL '3 years');
   --add constraint CK_CLIENT_DATENAISS
      --check (NOW()-dateNaissanceClient>=INTERVAL '18 y');

alter table AVIS
   add constraint CK_AVIS_NOTE
      check (noteAvis between 0 AND 5);

alter table DESCRIPTIONPANIER
   add constraint CK_DECRIT_QUANTITE
      check (quantite >= 1),
   add constraint CK_DECRIT_CHAMBRES
      check (nbChambresSimple <= 10 and nbChambresDouble <= 10 and nbChambresTriple <= 10);

alter table DESCRIPTIONPANIER
   add constraint CK_DESCRIPTIONPANIER_QUANTITE
      check (quantite >= 1),
   add constraint CK_DESCRIPTIONPANIER_CHAMBRES
      check (nbChambresSimple <= 10 and nbChambresDouble <= 10 and nbChambresTriple <= 10);

alter table DESCRIPTIONCOMMANDE
   add constraint CK_DESCRIPTIONCOMMANDE_QUANTITE
      check (quantite >= 1),
   add constraint CK_DESCRIPTIONCOMMANDE_CHAMBRES
      check (nbChambresSimple <= 10 and nbChambresDouble <= 10 and nbChambresTriple <= 10);

alter table HOTEL
   add constraint CK_HOTEL_CATEGORIE
      check (categorieHotel = null or categorieHotel between 1 and 5);

alter table RESTAURANT
   add constraint CK_RESTAURANT_ETOILES
      check (nombreEtoilesRestaurant = null or nombreEtoilesRestaurant between 1 and 3);

alter table ADRESSE
	
   add constraint CK_ADRESSE_EXCLUSIF
      check (idClient is not null or idPartenaire is not null);
	  
alter table COMMANDE
   add constraint CK_COMMANDE_ETAT
      check (ETATCOMMANDE IN ('En attente de validation', 'Paiement refusé', 'Annulé', 'Paiement validé')),
   add constraint CK_COMMANDE_TYPEPAIEMENT
      check (TYPEPAIEMENTCOMMANDE IN ('paypal', 'cb', 'stripe'));


------------------------------------------------- ROLES
INSERT INTO
	ROLES (libelleRole)
VALUES
	('Client'),
	('Service marketing'),
	('Service vente'),
	('Dirigeant');
	
------------------------------------------------- ROUTE_DES_VINS
INSERT INTO
	ROUTE_DES_VINS(TITREROUTE, DESCRIPTIONROUTE, PHOTOROUTE)
VALUES
	('ROUTE DES VINS D''ALSACE', 'Sans doute la plus connue des routes des vins en France, et assurément la plus ancienne ! Que cela soit à vélo ou en voiture, la routes des vins d''Alsace est parcourue par des millions de touristes chaque année, en quête de ses grands crus, ses fabuleux cépages, ses spécificités viticoles (citons les vendanges tardives), ses paysages vallonnés et villages pittoresques comme Colmar ou Riquewihr. Les vins d''Alsace, principalement blancs, sont réputés pour leur élégance, fraicheur et finesse. ','ALSACE.png'),
	('ROUTE DES VINS DU BEAUJOLAIS', 'Le Beaujolais Nouveau, bien sûr, mais pas que ! Vignoble souvent associé à sa production la plus médiatisée, le Beaujolais offre une incroyable diversité aromatique. Sans oublier de mentionner les paysages viticoles parmi les plus beaux de France en plein coeur du Vaux-en-Beaujolais, ...','BEAUJOLAIS.png'),
	('ROUTE DES VINS DE BORDEAUX', 'Bordeaux est la terre des vins par excellence. Des châteaux, des grands crus classés (parfois à des tarifs inabordables mais pas uniquement), la Garonne, le Médoc, le Libournais, le Sauternes et les Grave, Saint-Emilion … Voilà ce qui vous attend lors de votre tour du vignoble bordelais, au coeur de la Gironde à la découverte des 6 itinéraires des routes des vins de Bordeaux.','BORDEAUX.png'),
	('ROUTE DES VINS DE BOURGOGNE', 'Une visite des villages les plus renommés (si on vous dit Meursault, Pommard, Chablis, Vougeot, Nuit-Saint-George, Beaune), une route qui parcourt plus de 200 kilomètres entre Chablis et le vignoble Mâconnais… Vous serez parfois surpris d''y entendre parler japonais, chinois, anglais ou portugais, mais le monde entier nous envie les grands crus bourguignons, partageons-les ! Autant de circuit, de dégustations de vins, de domaines viticoles à découvrir le temps d''un week-end.','BOURGOGNE.png'),
	('ROUTE DES VINS DE CATALOGNE', 'Sillonner la route des vins de Catalogne revient, du nord au sud et d''est en ouest. Qu''attendez-vous pour partir ? Vous ne le regretterez pas ! Cette perle sera un paradis pour tous les sens.','CATALOGNE.png'),
	('ROUTE DES VINS DE CHAMPAGNE', 'Elle se compose de 6 itinéraires pour découvrir le plus célèbre des vins effervescents: les côteaux de Vitry, la vallée de la Marne ou la côtes des Blancs...Autant des parcours touristiques entre Reims, Epernay, pour mieux connaître le Champagne mais aussi la Champagne, ces deux-là étant bien entendu indissociables !','CHAMPAGNE.png'),
	('ROUTE DES VINS DU JURA', 'Très réputée pour son « Vins Jaune » qui a fait la renommée du vignoble jurassien, les itinéraires que nous vous proposons vous entraîneront à Arbois, Poligny et Lons-le-Saunier.','JURA.png'),
	('ROUTE DES VINS DE LANGUEDOC-ROUSSILLON', 'Des itinéraires (souvent) ensoleillés entre vin, montagne, garrigue, méditerranée ! Un véritable spectacle à ciel ouvert pour découvrir l''Hérault, cette route des vins vous mènera de caves en caves de Montpellier, à Pic-Saint-Loup, en passant par le Saint-Chinian ou dégustez les fameux Cabardès.','LANGUEDOC_ROUSSILLON.png'),
	('ROUTE DES VINS D''ILE-DE-FRANCE', 'L''Ile-de-France, notamment Paris, possède un vignoble fruit d''un héritage historique qui a favorisé l''implantation de vignes à proximité de la capitale, pour désaltérer la cour royale ! Aujourd''hui ne subsistent que quelques parcelles, dont la plupart ont une vocation touristique et pédagogique, comme les dernières vignes de Montmartre. ','ILE_DE_FRANCE.png'),
	('ROUTE DES VINS DE PROVENCE', 'A n''en pas douter l''un des vignobles les plus ensoleillés, attention au coup de chaud ! Heureusement, la douceur des vins rosés et la souplesse des vins blancs vous seront de précieux alliés à découvrir à travers les coteaux de Aix-en-provence, des vignes du Lubéron ou des Caves du Mont-Ventoux. Un vignoble intimiste dont les appellations méritent d''être découvertes !','PROVENCE.png'),
	('ROUTE DES VINS DE LA SAVOIE', 'Un périple œnologique et touristique autour de 4 départements alpins vous attend. Privilégiez la période hivernale, pour pouvoir déguster la fondue savoyarde avec les vins d''Apremont… !','SAVOIE.png'),
	('ROUTE DES VINS DU SUD-OUEST', 'On ne parle plus du bordelais, mais bien des magnifiques vignobles peuplant le vaste territoire qui s''étend des Pyrénées à l''Aveyron, en passant par Toulouse. Vous découvrirez les appellations de Cahors, de Gaillac, de Bergerac, du Madiran, d''Irouléguy, et bien d''autres.','SUD_OUEST.png'),
	('ROUTE DES VINS DE VAL DE LOIRE', 'Parcourir l''un des plus grands vignobles de France prend du temps, mais rien ne vous empêche d''y aller par étape. Initiez-vous aux joies du Sancerre, poursuivez avec la Touraine (et ses châteaux), l''Anjou et terminez par le pays nantais et ses muscadets. La vallée de la Loire conjugue ainsi patrimoine culturel avec ses châteaux renaissance et patrimoine viticole d''exception.','VAL_DE_LOIRE.png'),
	('ROUTE DES VINS DU RHÔNE', 'Une entente cordiale entre Nord et sud qui réjouira tous les amateurs de vins, de Condrieu à Châteauneuf-du-Pape. Au nord du vignoble, aux coteaux exposés au climat continental, fait face la partie méridionale et ses terres plus arides. La route des vins du Rhône est une escapade qui s''apprécie en nuances à l''exemple de la force du célèbre Côte-Rôtie, ou des vins de Gigondas....','RHÔNE.png');
------------------------------------------------- THEME
INSERT INTO
	THEME (libelleTheme)
VALUES
	('Gastronomie'),
	('Bien-être'),
	('Golf'),
	('Culture'),
	('Bio'),
	('Insolite');

------------------------------------------------- DUREE
INSERT INTO
	DUREE(libelleDuree)
VALUES
	('1 journée'),
	('2 jours / 1 nuit'),
	('3 jours / 2 nuits'),
	('Demi-journée');

------------------------------------------------- CATEGORIE VIGNOBLE
INSERT INTO
	CATEGORIEVIGNOBLE (libelleCategorieVignoble)
VALUES
	('Alsace'),
	('Beaujolais'),
	('Bordeaux'),
	('Bourgogne'),
	('Catalogne'),
	('Champagne'),
	('Jura'),
	('Languedoc-Roussillon'),
	('Paris'),
	('Provence'),
	('Savoie'),
	('Sud-Ouest'),
	('Val de Loire'),
	('Vallee du Rhône');

------------------------------------------------- LOCALITE
INSERT INTO
	LOCALITE(idCategorieVignoble, libelleLocalite)
VALUES
	(3, 'Entre-Deux-Mers'),
	(3, 'Graves'),
	(3, 'Médoc'),
	(3, 'Saint-Emilion'),
	(3, 'Sauternes'),
	(4, 'Chablis'),
	(4, 'Côte de Beaune'),
	(4, 'Côte de Nuits'),
	(4, 'Maconnais'),
	(6, 'Epernay'),
	(6, 'Reims'),
	(8, 'Corbières'),
	(8, 'Minervois'),
	(8, 'Roussillon'),
	(8, 'Saint-Chinian'),
	(10, 'Arrière-Pays'),
	(10, 'Littoral'),
	(12, 'Béarn'),
	(12, 'Dordogne'),
	(12, 'Gaillac'),
	(12, 'Gers'),
	(12, 'Lot'),
	(12, 'Pays Basque'),
	(13, 'Anjou'),
	(13, 'Chinon'),
	(13, 'Nantes'),
	(13, 'Sancerre'),
	(13, 'Saumur'),
	(13, 'Touraine'),
	(14, 'Châteauneuf-du-Pape'),
	(14, 'Condrieu'),
	(14, 'Côte-Rôtie'),
	(14, 'Gigondas'),
	(14, 'Grignan'),
	(14, 'Hermitage');



------------------------------------------------- SE LOCALISE
INSERT INTO
	SE_LOCALISE (IDROUTE, IDCATEGORIEVIGNOBLE)
VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 4),
	(5, 5),
	(6, 6),
	(7, 7),
	(8, 8),
	(9, 9),
	(10, 10),
	(11, 11),
	(12, 12),
	(13, 13),
	(14, 14);

------------------------------------------------- CATEGORIE PARTICIPANT
INSERT INTO
	CATEGORIEPARTICIPANT (libelleCategorieParticipant)
VALUES
	('Couple'),
	('Amis'),
	('Famille');

------------------------------------------------- TYPE DEGUSTATION
INSERT INTO
	TYPEDEGUSTATION (libelleTypeDegustation)
VALUES
	('Degustation de Vins Rouges'),
	('Degustation de Vins Blancs'),
	('Degustation de Vins Roses'),
	('Degustation de Vins Bio'),
	('Degustation en Terroir'),
	('Degustation de Vins Millesimes'),
	('Degustation de Vins Vieux'),
	('Atelier de Degustation avec un Sommelier'),
	('Degustation en Cave Particuliere'),
	('Degustation de Vins et Fromages');
	
------------------------------------------------- CLIENT
INSERT INTO
	CLIENT (civiliteClient, idRole, prenomClient, nomClient, emailClient, dateNaissanceClient, motDePasseClient, offresPromotionnellesClient, dateDerniereActiviteClient, TELEPHONECLIENT)
VALUES
	('M', 1, 'Elliott', 'Serena', 'serenaelliott8820@google.com', '1977-02-18', '$2y$12$oG8AVZThhOQp3Huf3yPSsOjklPDT.wTdMdTsYKrwXTWVtngfnm7AG', 'False','2022-05-08','0767662202'),
	('M', 1, 'Houston', 'Isaiah', 'i_houston8482@yahoo.fr', '1997-06-09', '$2y$12$T7aFs0JYqyVIFsqDKlpZpOqCNS4zNBaA7Olxbn5s4CexFEUPb85M6', 'True','2024-07-21','0637056342'),
	('M', 1, 'Beard', 'Zenaida', 'bzenaida9389@icloud.fr', '1964-07-11', '$2y$12$tDvZzbMipr7TduC2//x64ecFpFxS7d2nkolu6ukKQbJI6aHC/rF82', 'False','2023-08-26','0634303099'),
	('M', 1, 'Hewitt', 'Alma', 'hewitt.alma1314@yahoo.com', '1962-02-02', '$2y$12$MnLYDNoErNM70hHDorkt/uZ7ktwMKQdHO4G/QO.tuZiJVVfggLss2', 'True','2023-05-20','0794788234'),
	('M', 1, 'Morse', 'Daniel', 'm-daniel@google.com', '1995-01-04', '$2y$12$YgE5UebR2l1etg3Pf/if3uOUYgpKn80gnl9ZDmZkvwn5rVUHU.Qey ', 'True','2023-06-13','0722774688'),
	('M', 1, 'Wallace', 'Charity', 'wallace.charity@outlook.fr', '2004-05-19', '$2y$12$3CnriwLciJuF5q8Z2NQeE.VOdG4uM8UQ0ZzMDI2z4B7T2OPZrwNKO ', 'False','2022-03-13','0612207228'),
	('Mlle', 1, 'Bright', 'Karleigh', 'karleigh-bright@yahoo.fr', '1989-05-06', '$2y$12$510HXLToXaX.WcPTRt93o.Jd8cKX8wM0kzEiOZg9.bkXeqyu9QFzq ', 'False','2023-10-01','0768109082'),
	('Mlle', 1, 'Quinn', 'Eaton', 'eaton-quinn6882@icloud.fr', '1963-10-03', '$2y$12$6bvIIB/usUxh6xu8gpxJCeeC40JAhWeHdRwRMZuM7Xb2WGPa/wcF6', 'False','2024-03-17','0735632316'),
	('Mlle', 1, 'Parks', 'Alexa', 'p_alexa5631@google.fr', '2002-09-02', '$2y$12$25hWZiSNEr1stpiydsG2.uh/ugVQgsn/vbRcyU0Yg7aGyF4M0WTHi', 'True','2023-05-28','0645416824'),
	('M', 1, 'Stanley', 'Cassidy', 'cassidystanley4658@icloud.com', '1973-09-28', '$2y$12$T7ZFvO0/gxkXrMtlvFmXU.assb889M7xeaK.03HRjGuvu1tsvJ3ZW', 'False','2023-03-31','0687113083'),
	('Mme', 1, 'Gould', 'Hanna', 'hannagould@icloud.fr', '2002-08-25', '$2y$12$gTUNuw/XpLnGEjypvo2BTOv5BEEHWs6uLqUQubzPQOjmbjt8fl7Ma', 'True','2022-03-20','0701771126'),
	('Mlle', 1, 'Reyes', 'Daniel', 'danielreyes8150@google.com', '1979-05-08', '$2y$12$oXfxFYh6ZVRAtGTV9h7TTeMSVo9wRaUobP71QJxRxLSyuSDxVml.S', 'True','2024-01-09','0762691646'),
	('Mme', 1, 'Stokes', 'Raven', 'r.stokes@outlook.com', '1998-01-11', '$2y$12$a70Kyj8lpSxRmD4i4wn/c.fK1tAF8qvAOqri2ylEHgfAPCZ4mU41y', 'False','2024-08-30','0791223553'),
	('Mlle', 1, 'Merrill', 'Reese', 'rmerrill875@yahoo.com', '1978-10-29', '$2y$12$8fNLEUG0bdmfbgzE/ldNp.PnQ.YOEsSQimx7zgX5LFB7OvX69t136', 'True','2023-07-13','0777573234'),
	('Mme', 1, 'Dudley', 'Quail', 'dquail9287@google.com', '1993-04-19', '$2y$12$g5sJ3hPraxehIUqOevfNfO1Q3Yy4yhIf71Ik7Ae/8T0Zscby.nDbG', 'False','2023-05-28','0667181469'),
	('M', 1, 'Galloway', 'Rhea', 'rhea_galloway@outlook.fr', '1969-01-28', '$2y$12$x393WGhA/BGKNSccbPau4uCeH5ynaF8PYsfz6CegEhma9xw/Aj5V2', 'True','2022-12-31','0607264814'),
	('Mlle', 1, 'Jimenez', 'Margaret', 'jimenez-margaret7788@google.com', '1993-09-20', '$2y$12$u4gxI9a..6WV.zKAhwNeh.2Lo7Fft2hIqMLCo/KjPftCtYiHog.pO', 'False','2023-10-07','0756298295'),
	('Mme', 1, 'Roy', 'Leonard', 'rleonard@hotmail.fr', '1997-04-23', '$2y$12$b2Guf5QneGQEVYXW0lPbuOPy/Cxvn5nokrC2AWzYFZJJHs.iEnR6a', 'False','2023-04-29','0653756290'),
	('M', 1, 'Whitney', 'Keith', 'whitney-keith6811@google.fr', '2000-12-29', '$2y$12$6M4nCnhOi.UMai9LOcJqIu7GUrt6bppsYnE6JONgyYQGo8mJ5zeVG', 'False','2023-09-25','0718886362'),
	('Mme', 1, 'Sears', 'Gail', 'gail_sears@icloud.fr', '2001-01-17', '$2y$12$/LoLCuJBUCEHHcbLczByTeDMaB9kuQLf0CiCtXyEhDUdOoltyKUQy', 'True','2024-10-18','0723808127'),
	('Mlle', 1, 'Clements', 'Perry', 'perry.clements6445@yahoo.com', '1994-07-21', '$2y$12$bGxwpgYNtIUHQeJLbhqUCuCsOeNa5Y66BZDtKSyo8WNDegYUzRgT.', 'True','2023-10-22','0603966614'),
	('Mme', 1, 'Bass', 'Rae', 'rae-bass6126@yahoo.com', '1970-11-13', '$2y$12$BeO9dpyQ/YYNQRRQFkAvSufLs2qFVOjmkzdJMM6238254F3qQWKVC', 'False','2023-07-21','0662663238'),
	('Mlle', 1, 'Stuart', 'Tatiana', 'stuart-tatiana@icloud.com', '1974-09-23', '$2y$12$K.1f.M6Vn/DGaZVa1v3JqOk4Ul2JxlRiz0aIdykD45cbkxNoypqb2', 'False','2022-08-25','0611472177'),
	('Mlle', 1, 'Durham', 'Gage', 'g-durham@icloud.com', '1964-01-18', '$2y$12$RHKprCXOeZU28RCfw6Ib4.OyADLEzuhKMVaQ1dz/7JWW8R4ieDN/O', 'False','2022-03-03','0754987167'),
	('Mme', 1, 'Owens', 'Christopher', 'c-owens@hotmail.fr', '2006-08-16', '$2y$12$.PrDYMBinG4UeALkwBLOzuoUBdUajkpkhaGpxGK3iTpyD9ALlnMei', 'False','2023-04-01','0668288049'),
	('Mlle', 1, 'Bartlett', 'Maia', 'maia.bartlett@google.com', '2003-11-10', '$2y$12$VeZgWJLl6Gol06CqSoHy6eEk4cYKaIGY9W1Fe9chI2i3qDdsU6SH6', 'True','2022-07-09','0627263821'),
	('Mlle', 1, 'Branch', 'Derek', 'dbranch6752@outlook.com', '1995-02-08', '$2y$12$NzFQkVJ4wE1QPjAJqSZikuGP/YVkMvttjied19//DHJ1DwOZ2QlGm', 'True','2024-05-14','0621073828'),
	('Mme', 1, 'Nielsen', 'Amanda', 'n.amanda@yahoo.com', '1987-07-03', '$2y$12$Ar/pJ/oc2FkscqIV5Rn5SORHR9lALuShpdoe.jR4w1hs5ew7UcKLO', 'True','2022-05-09','0618351474'),
	('Mme', 1, 'Blackwell', 'Jonas', 'bjonas@yahoo.com', '1992-04-03', '$2y$12$NZDLkMisCpPpi8XP.ko5huLDcAryQpvsHi5j23dGBP5TdhCg4mNlm', 'True','2024-10-09','0732047834'),
	('Mlle', 1, 'Roman', 'Ali', 'rali@yahoo.fr', '1984-11-09', '$2y$12$BV3j8L6ACi84z1vAGaW/9.duICsuGYsY4qSAToHIRjw6v/Thkhd3q', 'False','2024-03-24','0696434046'),
	('M', 1, 'Mathews', 'Fulton', 'm-fulton4627@yahoo.fr', '1986-08-27', '$2y$12$c0qcb6DOM2rOBBYxnRa4eewMlOVbOb5zZ7LSeZrTXyJlWjudzqzXu', 'True','2023-01-27','0622103446'),
	('Mme', 1, 'Patterson', 'Justin', 'justin-patterson@google.fr', '1974-04-03', '$2y$12$hraoMRE1jxahfcbtCcD0GOpZ5914hT1AWlmF704zKu09tBkuX6U8O', 'True','2023-09-05','0747780259'),
	('M', 1, 'Salas', 'Wynter', 'salas-wynter1587@outlook.fr', '1971-01-04', '$2y$12$a.uNrpwK08AM4GAKfsr9hO9XAg2na7Z81B40yOyu7D/ofk1qkJTly', 'True','2022-04-18','0757626251'),
	('Mme', 1, 'Reyes', 'Natalie', 'natalie.reyes6824@yahoo.fr', '1967-03-30', '$2y$12$4U.20xCg7YxApXm0Df1mA.OV1MX9nnD9ZyH/tVvoZHb3k0tAN2bNC', 'True','2022-11-08','0657285525'),
	('Mme', 1, 'Glover', 'Bo', 'b-glover@yahoo.com', '1968-01-26', '$2y$12$v6ysj3SGMbXZPKvT5UImXOwvYqvibsXd9DcrWoYKnOwRqHh1GXmh2', 'False','2022-05-04','0626931827'),
	('Mlle', 1, 'Mercado', 'Yeo', 'yeomercado@hotmail.com', '1976-06-21', '$2y$12$R2XMKgnrnHS0hGtuIfjSXOZbRBaE0nOMOO3OrsY7XGDQx.UDp1Z8q', 'False','2024-03-01','0722785760'),
	('M', 1, 'Valdez', 'Samuel', 'valdez.samuel@hotmail.fr', '2006-04-10', '$2y$12$qDPwcFFwB04TvO.sCDkXWeQEzkvFy5E53yFx9Nw3eDnxpUDczdi2K', 'False','2024-10-19','0626122479'),
	('Mlle', 1, 'Hensley', 'Kennedy', 'kennedy_hensley1420@hotmail.fr', '1964-11-08', '$2y$12$Cz8OTQ7H2y/oiyj6zRNQpOUy6A9A5hcbnfo9wvJ5riR2i9MFeJ/v2', 'False','2022-04-08','0708837451'),
	('Mlle', 1, 'Atkins', 'Orla', 'oatkins@yahoo.fr', '1998-01-15', '$2y$12$rAGeQAaJN2CuAqiOvLKxP.hqeqTjrmVnvAeoVxCanpA5gHWWN5Ss2', 'True','2024-08-14','0605795163'),
	('M', 1, 'Gibson', 'Evangeline', 'gibson-evangeline@yahoo.fr', '1986-11-03', '$2y$12$fKGg5gWf7ceh1pAIGfm4VePtsqX1v8nBt91eNTeIqceUKvvpp3IJK', 'False','2022-04-17','0728168777'),
	('M', 1, 'Wheeler', 'Charissa', 'charissa_wheeler@icloud.fr', '1990-11-05', '$2y$12$lmE72e3C/JyU77qbsYFK5OfrXVXZC7erMY.O/bC.dCn1aIk7TLCFW', 'True','2023-12-28','0717831053'),
	('Mlle', 1, 'Johns', 'Armando', 'armando.johns9353@outlook.fr', '1983-04-02', '$2y$12$agkF5wC0n64qnSxNB6u4z.4KMkoIW8MwYHE.4RX3zEc3wfGuSJnS6', 'False','2023-01-14','0778333086'),
	('M', 1, 'Mcdaniel', 'Caesar', 'm-caesar8163@hotmail.com', '2004-11-09', '$2y$12$fvR7U1RyYv/Ne9oDbkgAQue0QwJUxBWjB5ANUmkzh3NX8R4iYnKai', 'False','2023-03-25','0768846761'),
	('Mme', 1, 'Battle', 'Elliott', 'b.elliott@outlook.fr', '2003-11-29', '$2y$12$djQmZK.n2fL9cXgk0llDNOczA06MaIBZ16EYT/gLm0R5o3BQ27VgS', 'False','2024-02-24','0678607562'),
	('Mme', 1, 'Thornton', 'Gil', 't_gil@google.com', '1961-07-23', '$2y$12$1ZoFbE/l/6DsVsbg7lta6efNFDymgUiyMW.Mcm9riquqQleEBvWly', 'True','2022-03-08','0655357110'),
	('Mme', 1, 'Washington', 'Rinah', 'rinah-washington@outlook.com', '2000-10-08', '$2y$12$Qb1wngnzB0q3tBkbw1JG7egKQFk.FodOgLrKM2gJtFgzPaUV1uC1a', 'True','2023-12-06','0687134476'),
	('M', 1, 'Gaines', 'Kelly', 'gkelly3905@google.com', '1998-09-06', '$2y$12$SkxxhIbaWj3HZHV67GL8yesNId6ea9CiAa9xLtzIBgGKD/bRK7sPm', 'False','2024-10-06','0657532720'),
	('Mme', 1, 'Holt', 'Gavin', 'h_gavin@google.com', '2003-05-23', '$2y$12$iUivNOYQx1MEf/zNAYFeX.w3QsXEIn9xRAxsj5snjMuH271qwiQQS', 'False','2022-07-27','0706742458'),
	('Mlle', 1, 'Burch', 'Inez', 'inez.burch5236@hotmail.com', '1986-03-16', '$2y$12$EfF.UraWgKA2Xss/MZdgWOSVPW4a6UFgnhHItz049INQm7Te3jF5G', 'True','2024-08-29','0658575212'),
	('Mme', 1, 'Randall', 'Maggie', 'randall_maggie4776@google.fr', '1963-09-13', '$2y$12$154ccb6/K0Mtkn4VBXIyN.l0IbL/Swqzz2P6vtuKzjiTGJeBA8zGq', 'False','2022-09-11','0715177544'),
	('M', 3, 'Vente', 'Service', 'servicevente@gmail.com', '2000-09-13', '$2y$12$UZrFuCpTum4Z3s3IHF5d.eLnMGPErg5JQ4JfUufXATr29qpxMnbV2', 'False','2022-09-11','0602780180'),
	('M', 4, 'Dodey', 'Kenny', 'kenny_dodey@google.fr', '2005-01-13', '$2y$12$1O3DET3NhybnUUmmrQAaA.sYP2.4RgjZenW8qzu2wrfAT5uSZy6GO', 'False','2022-09-11','0718590626'),
	('M', 1, 'Vino', 'Client', 'client.vinotrip@gmail.com', '2005-02-13', '$2y$12$oG8AVZThhOQp3Huf3yPSsOjklPDT.wTdMdTsYKrwXTWVtngfnm7AG', 'False','2022-09-11','0695738371'),
	('M', 2, 'Carpentier', 'Aina', 'aina.carpentier@vinotrip.fr', '1900-09-13', '$2y$12$WQlLswWkAfV8DGxVEfc/3.mNYNoHj.B/kZcJQA6vcZ3beLHBg0gx6', 'False','2022-09-11','0788524453'),
	('M', 4, 'Magnenat', 'Lou', 'vinotrip@lmgt.me', '2006-07-30', '$2y$12$TQ2Z.PnyLE4v5tTOkDX3Ee9txFQIzl38J.QPw/JuUAIr3FZFTlSzy', 'False','2022-09-11','0772241781');

------------------------------------------------- CARTE_BANCAIRE	
INSERT INTO 
	CARTE_BANCAIRE(idClient,titulairecb, numerocbClient, dateExpirationcbClient)
VALUES
	(1, 'Serena Elliott', '4485471865775737', '2029-06-01'),
	(2, 'Isaiah Houston', '5254535266882791', '2030-02-01'),
	(3, 'Zenaida Beard', '4799755643335223', '2028-07-01'),
	(4, 'Alma Hewitt', '5565323787187824', '2028-01-01'),
	(5, 'Daniel Morse', '5288129269766464', '2025-12-01'),
	(6, 'Charity Wallace', '4556836815218125', '2029-12-01'),
	(7, 'Karleigh Bright', '5324358234444149', '2027-07-01'),
	(8, 'Eaton Quinn', '5456986268727862', '2025-01-01'),
	(9, 'Alexa Parks', '4672255722483624', '2025-01-01'),
	(10, 'Cassidy Stanley', '5247895582864539', '2030-06-01'),
	(11, 'Hanna Gould', '4532379772268378', '2028-05-01'),
	(12, 'Daniel Reyes', '5248614282141265', '2029-02-01'),
	(13, 'Raven Stokes', '4485265652144234', '2026-11-01'),
	(14, 'Reese Merrill', '4556555675897337', '2029-02-01'),
	(15, 'Quail Dudley', '4929269841871784', '2025-11-01'),
	(16, 'Rhea Galloway', '4916837574684767', '2027-02-01'),
	(17, 'Margaret Jimenez', '5591638817586325', '2026-03-01'),
	(18, 'Leonard Roy', '4556516842466760', '2028-04-01'),
	(19, 'Keith Whitney', '4539222642558292', '2029-11-01'),
	(20, 'Gail Sears', '5432355589282636', '2029-04-01'),
	(21, 'Perry Clements', '5587969816743849', '2028-07-01'),
	(22, 'Rae Bass', '4556485162729787', '2028-06-01'),
	(23, 'Tatiana Stuart', '5343287775778861', '2025-03-01'),
	(24, 'Gage Durham', '5385415442662445', '2028-07-01'),
	(25, 'Christopher Owens', '5438845246287980', '2030-01-01'),
	(26, 'Maia Bartlett', '4024007146848972', '2029-12-01'),
	(27, 'Derek Branch', '5228844413984390', '2030-04-01'),
	(28, 'Amanda Nielsen', '4916257247336143', '2030-01-01'),
	(29, 'Jonas Blackwell', '5176956738784974', '2030-01-01'),
	(30, 'Ali Roman', '4556663683945385', '2030-11-01'),
	(31, 'Fulton Mathews', '4024007176278660', '2027-01-01'),
	(32, 'Justin Patterson', '4024007165424549', '2025-12-01'),
	(33, 'Wynter Salas', '5372143856351827', '2025-11-01'),
	(34, 'Natalie Reyes', '4024007169145157', '2028-08-01'),
	(35, 'Bo Glover', '5485176831545117', '2030-04-01'),
	(36, 'Yeo Mercado', '5185263395476328', '2030-02-01'),
	(37, 'Samuel Valdez', '5336324572559324', '2025-12-01'),
	(38, 'Kennedy Hensley', '4532624512468162', '2025-10-01'),
	(39, 'Orla Atkins', '5363565138594819', '2028-12-01'),
	(40, 'Evangeline Gibson', '4485457665818827', '2027-07-01'),
	(41, 'Charissa Wheeler', '5345866646646973', '2029-08-01'),
	(42, 'Armando Johns', '4532466778574238', '2028-09-01'),
	(43, 'Caesar Mcdaniel', '5175418178878353', '2029-08-01'),
	(44, 'Elliott Battle', '5194165445873132', '2029-08-01'),
	(45, 'Gil Thornton', '5488634828998688', '2027-11-01'),
	(46, 'Rinah Washington', '4413682884541416', '2028-11-01'),
	(47, 'Kelly Gaines', '5376868614673411', '2028-09-01'),
	(48, 'Gavin Holt', '5469857382433437', '2030-12-01'),
	(49, 'Inez Burch', '4539498765284482', '2027-07-01'),
	(50, 'Maggie Randall', '5267452565447521', '2030-04-01'),
	(51, 'Service Vente', '5267452565447421', '2030-04-01'),
	(52, 'Kenny Dodey', '5264452565447421', '2030-04-01'),
	(53, 'Client Vino', '5264452565447421', '2030-04-01'),
	(54, 'Aina Carpentier', '5267452565147421', '2030-04-01');

------------------------------------------------- PARTENAIRE
INSERT
	INTO PARTENAIRE (nomPartenaire, mailPartenaire, telPartenaire)
VALUES
	('Domaine du Vieux Lavoir', 'contact@vieuxlavoir.com', '0623456789'),
	('Château de la Vigne', 'info@chateau-vigne.com', '0712345678'),
	('Le Clos des Vins de la Montagne', 'contact@closvinsmontagne.com', '0634598765'),
	('Domaine de la Terre Promise', 'contact@terrepromise.com', '0611122334'),
	('Vin et Voyage', 'contact@vinvoyage.com', '0723456987'),
	('Les Vins du Soleil', 'info@vinsdusoleil.com', '0689123456'),
	('Domaine du Château d''Or', 'contact@chateau-or.com', '0756789012'),
	('La Maison des Vins', 'contact@maisondesvins.com', '0623456890'),
	('Les Vins de la Cite', 'info@vinsdelacite.com', '0678901234'),
	('Caveau des Millesimes', 'contact@caveaumillesimes.com', '0654321098'),
	('Hôtel Le Meridien', 'contact@meridienhotel.com', '0148567890'),
	('Hôtel des Arts', 'info@hotelarts.com', '0156789012'),
	('Luxe & Nature Resort', 'reservation@luxenature.com', '0167890123'),
	('Auberge de la Vallee', 'contact@aubergelavallee.com', '0178901234'),
	('Hotel Grand Paris', 'info@grandparishotel.com', '0189012345'),
	('Hôtel Le Château Blanc', 'info@chateaublanc.com', '0190123456'),
	('Le Riviera Hôtel', 'reservation@riviera-hotel.com', '0201234567'),
	('Hôtel Le Cloâtre', 'contact@lecloitrehotel.com', '0212345678'),
	('Palace Hôtel des Dunes', 'info@palace-dunes.com', '0223456789'),
	('Hôtel Les etoiles de Provence', 'reservation@etoilesprovence.com', '0234567890'),
	('Le Gourmet de Paris', 'contact@gourmetparis.com', '0145678901'),
	('Le Jardin d''epicure', 'info@jardinepicure.com', '0156789012'),
	('L''Auberge de la Côte', 'contact@aubergelacote.com', '0167890123'),
	('La Table de Monsieur Paul', 'reservation@tablepaul.com', '0178901234'),
	('Le Ristorante Bella Vita', 'info@bellavita.com', '0189012345'),
	('Chez Antoine', 'contact@chezantoine.com', '0190123456'),
	('Le Bistrot de la Mer', 'contact@bistrotmer.com', '0201234567'),
	('Le Château des Saveurs', 'info@chateausaveurs.com', '0212345678'),
	('La Brasserie du Parc', 'contact@brasserieparc.com', '0223456789'),
	('Le Cordon Bleu', 'contact@cordonbleu.com', '0234567890'),
	('Le Cafe de la Paix', 'reservation@cafepai.com', '0245678901'),
	('L''Assiette Gourmande', 'info@assiettegourmande.com', '0256789012'),
	('Le Petit Bistro du Vieux Lyon', 'contact@petitbistrolyon.com', '0267890123'),
	('La Table d''Helene', 'reservation@tablehelene.com', '0278901234'),
	('Le Gourmet Voyageur', 'contact@gourmetvoyageur.com', '0289012345'),
	('La Cave des Vins Raffines', 'contact@vinsraffines.com', '0145678901'),
	('Caveau des Grands Crus', 'info@caveaugrandscrus.com', '0156789012'),
	('Le Cellier des epicuriens', 'contact@cellier-epicuriens.com', '0167890123'),
	('Cave des Coteaux', 'reservation@cave-coteaux.com', '0178901234'),
	('La Cave de la Vigne d''Or', 'info@cavedelavigneor.com', '0189012345'),
	('Le Vieux Cellier', 'contact@vieuxcellier.com', '0190123456'),
	('Les Vins du Terroir', 'contact@vinsduterroir.com', '0201234567'),
	('Cave du Château de la Loire', 'info@caveloire.com', '0212345678'),
	('La Caverne des Vins Precieux', 'reservation@cavernedesvins.com', '0223456789'),
	('Le Cellier de l''Abbaye', 'contact@cellierabbaye.com', '0234567890'),
	('La Cave a Vins du Terroir', 'contact@cavevinsterroir.com', '0245678901'),
	('Les Secrets de la Cave', 'info@secretsdelacave.com', '0256789012'),
	('Le Domaine des Vins Gourmets', 'contact@domainevinsgourmets.com', '0267890123'),
	('Les Caves de l''Hermitage', 'contact@caveshermitage.com', '0278901234'),
	('Le Cellier des Sommeliers', 'info@cellier-sommeliers.com', '0289012345');

------------------------------------------------- ADRESSE
INSERT INTO
	adresse (idClient, idPartenaire, nomadresse, prenomadressedestinataire, nomadressedestinataire, rueAdresse, villeAdresse, CPAdresse)
VALUES
	(1, 5,   'Maison principale',  'Houston', 'Isaiah', '7 Boulevard Carnot', 'Troyes', 10000),
	(2, 19,  'Maison principale', 'Elliott', 'Serena', '18 Boulevard Foch',  'Thionville', 57100),
	(2, 19,  'Maison secondaire', 'Elliott', 'Serena', '4 Rue du Maréchal Foch',  'Schiltigheim', 67300),
	(3, 43,  'Chez mamie', 'Beard', 'Zenaida',  '9 Rue du Général de Gaulle',  'Bastia', 20200),
	(4, 28,  'Chez papi', 'Hewitt', 'Alma',  '8 Rue Saint-Malo',  'Rennes', 35000),
	(50, 35,  'Maison principale', 'Morse', 'Daniel', '10 Rue des Artisans',  'Brive-la-Gaillarde', 24480),
	(5, 8,   'Maison principale', 'Wallace', 'Charity', '5 Rue de l''Abbé Darrasse',  'Mont-de-Marsan', 40000),
	(6, 36,  'Maison principale', 'Bright', 'Karleigh', '5 Rue du Président Salvador Allende',  'Rennes', 35000),
	(7, 3,   'Appartement', 'Quinn', 'Eaton', '10 Rue des Tanneurs',  'Moulins', 3000),
	(9, 46,  'Chez maman', 'Parks', 'Alexa',  '3 Rue de la Barre',  'Dijon', 21000),
	(10, 12,  'Maison principale', 'Stanley', 'Cassidy', '19 Place du Champ de Mars',  'Angoulême', 16000),
	(11, 27,  'Chez maman', 'Gould', 'Hanna',  '25 Avenue des Palmiers',  'Hyères', 83400),
	(11, 28,  'Maison principale', 'Reyes', 'Daniel', '16 Avenue des Pins',  'Tournefeuille', 89852),
	(13, 38,  'Appartement', 'Stokes', 'Raven', '6 Place Kléber',  'Strasbourg', 67000),
	(14, 47,  'Chez papi', 'Merrill', 'Reese',  '6 Boulevard de la Madeleine',  'Beauvais', 60000),
	(14, 5,   'Maison principale', 'Dudley', 'Quail', '9 Rue des Artisans',  'Brive-la-Gaillarde', 19100),
	(14, 1,   'Maison principale', 'Galloway', 'Rhea', '13 Rue Pasteur',  'Dole', 39100),
	(15, 47,  'Maison principale', 'Jimenez', 'Margaret', '25 Rue de Vesle',  'Reims', 51100),
	(16, 23,  'Chez mamie', 'Roy', 'Leonard',  '5 Rue de la République',  'Dijon', 21000),
	(17, 42,  'Maison principale', 'Whitney', 'Keith', '12 Rue du 4 Septembre',  'Béziers', 34500),
	(17, 35,  'Maison principale', 'Sears', 'Gail', '15 Rue Pasteur',  'Dole', 78938),
	(18, 39,  'Maison principale', 'Clements', 'Perry', '10 Rue des Capucins',  'Mâcon', 52231),
	(19, 12,  'Maison principale', 'Bass', 'Rae', '20 Rue de l''Embranchement',  'Gap', 5000),
	(20, 32,  'Chez papi', 'Stuart', 'Tatiana',  '14 Rue de la Loire',  'Tours', 37000),
	(23, 24,  'Maison principale', 'Durham', 'Gage', '15 Rue de la Solidarité',  'Colombes', 87020),
	(24, 13,  'Maison de vacances', 'Owens', 'Christopher',  '3 Rue de la Forêt',  'Haguenau', 67500),
	(26, 20,  'Chez mamie', 'Bartlett', 'Maia',  '34 Avenue de l''Industrie',  'Tournefeuille', 31170),
	(27, 36,  'Appartement', 'Branch', 'Derek', '15 Rue de la Résistance',  'Brive-la-Gaillarde', 19100),
	(28, 1,   'Appartement', 'Nielsen', 'Amanda', '13 Rue de la Gare',  'Niort', 79000),
	(30, 50,  'Chez papa', 'Blackwell', 'Jonas',  '7 Rue des Auteurs',  'Limoges', 87000),
	(31, 5,   'Chez papa', 'Roman', 'Ali',  '18 Rue de la Paix',  'Strasbourg', 67000),
	(32, 23,  'Chez maman', 'Mathews', 'Fulton',  '11 Rue Gambetta',  'Tarbes', 65000),
	(33, 30,  'Chez papi', 'Patterson', 'Justin',  '16 Quai de la République',  'La Rochelle', 17000),
	(33, 10,  'Maison principale', 'Salas', 'Wynter', '11 Rue de la Solidarité',  'Colombes', 92700),
	(34, 44,  'Chez papa', 'Reyes', 'Natalie',  '28 Rue du Cygne',  'Chartres', 28000),
	(35, 34,  'Chez papi', 'Glover', 'Bo',  '17 Rue des Ardennes',  'Nevers', 58000),
	(37, 44,  'Appartement', 'Mercado', 'Yeo',  '22 Avenue de la République',  'Vernon', 27200),
	(39, 2,   'Chez maman', 'Valdez', 'Samuel',  '11 Rue Stanislas',  'Nancy', 54000),
	(40, 25,  'Appartement', 'Hensley', 'Kennedy', '9 Rue de la Madeleine',  'Laval', 53000),
	(40, 14,  'Maison principale', 'Atkins', 'Orla', '18 Rue des Capucins',  'Mâcon', 71000),
	(40, 17,  'Maison principale', 'Gibson', 'Evangeline', '15 Rue de l''Abbé Darrasse',  'Mont-de-Marsan', 94155),
	(41, 31,  'Adresse principale', 'Wheeler', 'Charissa',  '15 Rue de la Liberté',  'Mont-de-Marsan', 40000),
	(42, 46,  'Maison principale', 'Johns', 'Armando', '21 Rue de la Cité',  'Carcassonne', 11000),
	(43, 6,   'Appartement', 'Mcdaniel', 'Caesar', '22 Rue du 14 Juillet',  'Évreux', 27000),
	(44, 45,  'Chez papa', 'Battle', 'Elliott',  '12 Boulevard des Pyrénées',  'Pau', 64000),
	(45, 19,  'Chez maman', 'Thornton', 'Gil',  '30 Rue de la Bretonnerie',  'Rezé', 44400),
	(46, 28,  'Chez mamie', 'Washington', 'Rinah',  '8 Avenue de la Libération',  'Salon-de-Provence', 13300),
	(47, 37,  'Chez mamie', 'Gaines', 'Kelly',  '10 Rue du Général Leclerc',  'Soissons', 2200),
	(48, 22,  'Chez papi', 'Holt', 'Gavin',  '19 Rue de la Mairie',  'Douai', 59500),
	(48, 15,  'Maison principale', 'Burch', 'Inez', '6 Avenue des Pins',  'Tournefeuille', 31170),
	(49, 35,  'Chez papa', 'Randall', 'Maggie',  '21 Rue des Vins',  'Colmar', 68000),
	(53, 46,  'Maison principale', 'Vente', 'Service', '21 Rue de la Cité',  'Carcassonne', 11000),
	(53, 13,  'Maison de vacances', 'Vente', 'Service',  '3 Rue de la Forêt',  'Haguenau', 67500),
	(55, 40,  'Principal', 'A', 'B', 'C', 'D', 74000);

------------------------------------------------- CATEGORIE SEJOUR
INSERT INTO
	CATEGORIESEJOUR (libelleCategorieSejour)
VALUES
	('Culture'),
	('Gastronomie'),
	('Sport'),
	('Bien-être');

------------------------------------------------- SEJOUR
INSERT INTO
	sejour (idCategorieSejour, idTheme, idCategorieVignoble, idCategorieParticipant, idDuree, titreSejour, photoSejour, descriptionSejour, prixSejour, idLocalite, publie)
VALUES
	(2, 5, 4, 3, 2, 'Dégustation de vins réputés en Bourgogne', 'sejour1.jpg', 'Un séjour immersif au coeur d''un domaine viticole, avec des visites guidees des vignes et des degustations de vins uniques.', 727.00, 6, true),
	(4, 4, 1, 3, 3, 'Escapade gourmande', 'sejour2.jpg', 'Decouvrez les plaisirs de la gastronomie locale en associant mets raffines et vins d''exception dans un cadre pittoresque.', 673.00, null, true),
	(4, 1, 14, 3, 1, 'Week-end detente et vin', 'sejour3.jpg', 'Un week-end de detente dans un cadre tranquille, avec des visites de vignobles et des moments de relaxation en plein air.', 328.50, 30, true),
	(1, 1, 10, 1, 4, 'Séjour decouverte en Provence', 'sejour4.jpg', 'Plongez dans l''art de la viticulture provençale, visitez des domaines viticoles et profitez de la beaute des paysages.', 106.00, 24, true),
	(4, 6, 4, 2, 2, 'Escapade romantique au domaine', 'sejour5.jpg', 'Un séjour romantique dans un domaine vinicole, avec des activites de degustation et des repas aux chandelles dans les caves.', 645.00, 7, true),
	(4, 5, 4, 1, 3, 'Séjour tout inclus en Bourgogne', 'sejour6.jpg', 'Séjour tout compris avec transport, hebergement, visites des plus grands domaines viticoles et degustations de crus renommes.', 423.00, 10, true),
	(1, 4, 3, 3, 1, 'Séjour oenologique a Bordeaux', 'sejour7.jpg', 'Un séjour dedie a l''oenologie dans la region bordelaise, avec des ateliers de degustation et des visites des plus celebres châteaux.', 790.50, 11, true),
	(1, 4, 6, 1, 4, 'Séjour luxe en Champagne', 'sejour8.jpg', 'Vivez un séjour de luxe dans la region de Champagne, incluant des visites de maisons prestigieuses et des degustations de champagnes rares.', 431.00, null, true),
	(4, 3, 3, 2, 2, 'Séjour au château', 'sejour9.jpg', 'Sejournez dans un château viticole et profitez de visites privees, de degustations haut de gamme et de moments de relaxation dans un cadre idyllique.', 527.00, 3, true),
	(2, 3, 2, 1, 3, 'Séjour gastronomique et viticole', 'sejour10.jpg', 'Un séjour axe sur l''association des vins et des mets, avec des repas gastronomiques et des degustations de grands crus.', 126.00, null, true),
	(3, 1, 13, 2, 4, 'Aventure viticole dans le Val-de-Loire', 'sejour11.jpg', 'Explorez la vallee de la Loire a travers des visites de vignobles locaux, des degustations et des promenades en bateau.', 699.00, null, true),
	(4, 5, 14, 2, 1, 'Séjour dans les Côtes du Rhône', 'sejour12.jpg', 'Vivez un séjour inoubliable dans les Côtes du Rhône avec des visites de domaines, des degustations privees et des repas typiques de la region.', 680.50, 25, true),
	(1, 1, 7, 2, 2, 'Séjour decouverte des vins du Jura', 'sejour13.jpg', 'Un séjour unique a la decouverte des vins du Jura, avec des visites de caves, des degustations et des activites locales.', 229.00, 18, true),
	(4, 1, 1, 1, 3, 'Séjour au domaine en Alsace', 'sejour14.jpg', 'Sejournez dans un domaine viticole alsacien et explorez les traditions viticoles de la region a travers des visites et des degustations.', 514.00, 12, true),
	(2, 2, 2, 2, 1, 'Week-end vin et nature', 'sejour15.jpg', 'Un week-end en pleine nature, avec des randonnees dans les vignes, des degustations et des repas dans un cadre verdoyant.', 779.00, null, true),
	(4, 4, 4, 3, 4, 'Séjour decouverte de l''oenologie', 'sejour16.jpg', 'Apprenez les secrets de l''oenologie lors de ce séjour avec des ateliers pratiques et des visites de vignobles.', 288.00, 8, true),
	(4, 5, 4, 3, 2, 'Séjour spa et vins', 'sejour17.jpg', 'Profitez de l''alliance parfaite entre relaxation et degustation de vins dans un cadre spa luxueux au coeur d''un vignoble.', 601.50, 9, true),
	(2, 6, 9, 2, 3, 'Séjour de Noël au château', 'sejour18.jpg', 'Venez passer Noël au château, avec un programme de degustation de vins et de repas festifs dans une ambiance magique.', 588.00, null, true),
	(4, 3, 6, 2, 1, 'Séjour sur les traces du vin', 'sejour19.jpg', 'Un séjour sur mesure pour les passionnes de vin, avec des visites guidees et des decouvertes des meilleurs vignobles.', 757.00, 10, true),
	(4, 6, 4, 2, 4, 'Séjour au coeur de la Bourgogne', 'sejour20.jpg', 'Immersion totale dans le terroir bourguignon, avec des degustations de vins fins et des repas traditionnels.', 393.00, 6, true),
	(3, 3, 2, 1, 3, 'Séjour en amoureux dans les vignes', 'sejour21.jpg', 'Un séjour romantique, avec des chambres avec vue sur les vignes, des degustations de vin et des repas aux chandelles.', 474.00, null, true),
	(4, 5, 3, 3, 2, 'Séjour tout confort a Saint-Emilion', 'sejour22.jpg', 'Séjour tout confort dans la region de Saint-Emilion, avec des visites des plus prestigieux châteaux et degustations privees.', 209.00, 19, true),
	(3, 5, 1, 3, 4, 'Séjour nature et vin en montagne', 'sejour23.jpg', 'Séjour en montagne avec des randonnees au milieu des vignes et des degustations de vins de montagne dans un cadre exceptionnel.', 236.00, null, true),
	(2, 2, 7, 3, 1, 'Séjour a la decouverte des vins bio', 'sejour24.jpg', 'Un séjour axe sur la decouverte des vins biologiques, avec des visites de domaines ecoresponsables et des degustations en pleine nature.', 267.00, null, true),
	(2, 4, 11, 3, 2, 'Séjour decouverte en Savoie', 'sejour25.jpg', 'Venez decouvrir la Savoie sous un autre angle avec des visites de vignobles locaux et des degustations de vins typiques de la region.', 282.50, 7, true),
	(3, 3, 2, 2, 3, 'Séjour au coeur du Beaujolais', 'sejour26.jpg', 'Decouvrez les crus du Beaujolais avec des visites privees de vignobles et des degustations de vins renommes dans un cadre bucolique.', 635.00, 31, true),
	(4, 6, 8, 2, 4, 'Séjour oenologique en Languedoc', 'sejour27.jpg', 'Un séjour unique pour explorer les vins du Languedoc, avec des ateliers de degustation et des visites de caves historiques.', 437.00, 8, true),
	(1, 6, 4, 1, 1, 'Escapade viticole a Chablis', 'sejour28.jpg', 'Venez explorer l''un des plus celebres vignobles de France, avec des degustations de Chablis, et une immersion dans l''histoire viticole de la region.', 163.00, null, true),
	(2, 5, 14, 3, 3, 'Séjour decouverte des vins de la vallee du Rhône', 'sejour29.jpg', 'Un voyage dans la vallee du Rhône pour decouvrir ses vins iconiques, avec des visites guidees de châteaux et des repas accord mets-vins.', 209.50, 16, true),
	(4, 6, 11, 3, 2, 'Séjour en Corse et ses vins', 'sejour30.jpg', 'Sejournez en Corse et decouvrez les vins locaux dans des caves familiales, tout en profitant de la mer et du soleil mediterraneen.', 528.00, null, true),
	(2, 6, 10, 2, 4, 'Séjour dans le Medoc', 'sejour31.jpg', 'Sejournez dans la region viticole du Medoc, avec des visites de grands crus classes et des degustations exceptionnelles.', 215.00, 17, true),
	(2, 1, 12, 1, 1, 'Séjour de luxe a Pomerol', 'sejour32.jpg', 'Sejournez dans un cadre de luxe, avec des visites privees de vignobles et des degustations dans la prestigieuse region de Pomerol.', 317.50, 20, true),
	(4, 2, 8, 1, 3, 'Séjour aventure et vin dans le sud-ouest', 'sejour33.jpg', 'Un séjour pour les aventuriers et les epicuriens, combinant randonnee dans les vignes et degustations de vins typiques du sud-ouest.', 281.00, 13, true),
	(1, 1, 3, 3, 4, 'Séjour vin et art a Bordeaux', 'sejour66.jpg', 'Un séjour unique a Bordeaux alliant art, culture et decouverte des meilleurs vins locaux, avec des visites de musees et de domaines viticoles.', 241.00, 4, true),
	(1, 2, 9, 1, 2, 'Séjour vin et patrimoine a Avignon', 'sejour34.jpg', 'Profitez de l''histoire et de l''art a Avignon tout en decouvrant les vins du Vaucluse avec des degustations et des visites guidees de domaines.', 505.50, null, true),
	(2, 1, 5, 2, 1, 'Séjour en Alsace, au coeur des vignes', 'sejour35.jpg', 'Sejournez en Alsace et partez a la decouverte de ses fameux vins blancs et de ses villages pittoresques, avec des visites de caves et des degustations.', 447.00, null, true),
	(2, 6, 10, 1, 4, 'Séjour au domaine de la Loire', 'sejour36.jpg', 'Un séjour dans la vallee de la Loire pour explorer les vins locaux tout en decouvrant les châteaux majestueux de la region.', 404.00, 16, true),
	(4, 6, 10, 1, 3, 'Séjour degustation a Chablis', 'sejour37.jpg', 'Un séjour exclusif dans la region de Chablis, avec des visites de vignobles et des degustations de grands crus blancs.', 162.00, 17, true),
	(3, 2, 7, 2, 2, 'Séjour decouverte de l''artisanat vinicole', 'sejour38.jpg', 'Visitez des domaines viticoles familiaux, decouvrez l''artisanat de la production de vin et participez a des ateliers pratiques.', 763.00, null, true),
	(1, 3, 4, 1, 1, 'Séjour oenologique dans les Côtes de Provence', 'sejour39.jpg', 'Explorez les vins roses celebres de la region, avec des visites de domaines viticoles et des moments de detente sur la Côte d''Azur.', 239.00, 9, true),
	(4, 4, 13, 3, 4, 'Séjour a la decouverte des grands crus de Bordeaux', 'sejour40.jpg', 'Un séjour dans la region bordelaise pour decouvrir les meilleurs grands crus classes et deguster les vins au coeur des prestigieux châteaux.', 345.50, 26, true),
	(3, 5, 3, 1, 3, 'Séjour viticole et bien-être', 'sejour41.jpg', 'Séjour alliant detente et decouverte, avec des soins au spa et des degustations de vins dans un cadre tranquille et raffine.', 779.00, 1, true),
	(2, 4, 10, 1, 2, 'Séjour romantique en Savoie', 'sejour42.jpg', 'Un séjour romantique dans les montagnes savoyardes, avec des degustations de vins locaux et des moments privilegies en amoureux.', 506.00, 16, true),
	(2, 4, 14, 2, 4, 'Séjour au coeur du terroir du Roussillon', 'sejour43.jpg', 'Un séjour pour les amoureux du vin et de la nature, avec des visites de vignobles ensoleilles et des degustations de vins du sud de la France.', 656.00, 32, true),
	(2, 3, 4, 1, 1, 'Séjour viticole et cuisine provençale', 'sejour44.jpg', 'Un séjour gastronomique où le vin de Provence s''associe a une cuisine locale typique pour une experience inoubliable.', 128.00, 6, true),
	(2, 5, 8, 1, 3, 'Séjour vin et paysages en Champagne', 'sejour45.jpg', 'Visitez la region de Champagne et decouvrez l''art de la production de champagne, avec des degustations privees et des visites de caves prestigieuses.', 709.00, 14, true),
	(4, 2, 7, 1, 2, 'Séjour dans les vignes en Languedoc', 'sejour46.jpg', 'Sejournez au coeur des vignobles du Languedoc, avec des degustations de vins locaux et une immersion dans la culture viticole de la region.', 502.50, null, true),
	(3, 6, 8, 1, 4, 'Séjour en famille a la decouverte du vin', 'sejour47.jpg', 'Un séjour adapte a toute la famille, avec des activites ludiques pour enfants et des degustations pour adultes dans un cadre agreable.', 748.00, 15, true),
	(1, 6, 6, 1, 1, 'Séjour autour du vin a Bordeaux', 'sejour48.jpg', 'Explorez les vins de Bordeaux a travers des visites de domaines historiques et des degustations de celebres crus classes.', 617.00, 11, true),
	(2, 5, 14, 2, 2, 'Séjour de degustation en Haute-Savoie', 'sejour49.jpg', 'Decouvrez les vins savoyards, associes a des specialites locales dans un cadre montagnard exceptionnel.', 654.00, 33, true),
	(3, 6, 3, 2, 3, 'Séjour a la decouverte des vins de Loire', 'sejour50.jpg', 'Un séjour au coeur des vignobles de la Loire, avec des visites guidees de domaines viticoles et des degustations de vins varies.', 289.00, 2, true),
	(3, 6, 8, 2, 4, 'Séjour vin et art de vivre en Provence', 'sejour51.jpg', 'Venez decouvrir l''art de vivre provençal avec des visites de vignobles, des degustations de vins et des moments de relaxation au coeur de la nature.', 161.00, 12, true),
	(2, 5, 3, 1, 3, 'Séjour dans un vignoble de Saint-emilion', 'sejour52.jpg', 'Un séjour inoubliable dans un vignoble de Saint-emilion, avec des visites privees et des degustations de vins prestigieux.', 700.50, 5, true),
	(2, 5, 1, 3, 1, 'Séjour bien-être et vin en Languedoc', 'sejour53.jpg', 'Un séjour alliant detente au spa et degustation de vins locaux dans un cadre exceptionnel en Languedoc.', 744.00, null, true),
	(3, 4, 2, 3, 4, 'Séjour vin et gastronomie a Lyon', 'sejour54.jpg', 'Venez decouvrir la gastronomie lyonnaise et les vins du Beaujolais a travers un séjour de luxe alliant decouvertes culinaires et oenologiques.', 288.00, null, true),
	(3, 4, 4, 1, 2, 'Séjour dans un domaine viticole familial', 'sejour55.jpg', 'Sejournez dans un domaine viticole familial et apprenez l''art de la vinification, tout en profitant d''une atmosphere conviviale.', 527.00, 7, true),
	(3, 2, 14, 2, 3, 'Séjour decouverte des vins du Sud-Est', 'sejour56.jpg', 'Un séjour au coeur des vignobles du Sud-Est, avec des degustations de vins mediterraneens et des visites de villages pittoresques.', 421.50, 34, true),
	(1, 6, 4, 3, 1, 'Séjour romantique en Bourgogne', 'sejour57.jpg', 'Sejournez dans un cadre romantique en Bourgogne, avec des promenades dans les vignes et des repas en amoureux accompagnes de vins locaux.', 415.00, 8, true),
	(4, 6, 10, 1, 4, 'Séjour decouverte du vin en Ardeche', 'sejour58.jpg', 'Un séjour dans le sud de la France pour decouvrir les vins d''Ardeche, associes a des activites de plein air et des repas typiques.', 400.00, 17, true),
	(2, 3, 7, 2, 2, 'Séjour oenotourisme a la decouverte des grands terroirs', 'sejour59.jpg', 'Explorez les plus grands terroirs viticoles français a travers des visites et des degustations exclusives dans des domaines reputes.', 706.00, null, true),
	(4, 1, 6, 1, 3, 'Séjour luxe et vins en Côtes du Rhône', 'sejour60.jpg', 'Un séjour de luxe dans les Côtes du Rhône avec des degustations de vins rares et des visites privees de grands domaines.', 380.50, 10, true),
	(3, 5, 1, 3, 1, 'Séjour oenologique en Vallee du Douro', 'sejour61.jpg', 'Partez a la decouverte des vins du Douro au Portugal avec des visites de caves et des degustations de vins du Porto.', 465.00, null, true),
	(2, 2, 4, 3, 4, 'Séjour dans les vignes de la côte d''Azur', 'sejour62.jpg', 'Sejournez dans la region ensoleillee de la Côte d''Azur et decouvrez ses vins roses, tout en profitant de la mer et des paysages magnifiques.', 383.00, 9, true),
	(1, 1, 14, 3, 2, 'Séjour au domaine viticole de Loire', 'sejour63.jpg', 'Un séjour au coeur des vignobles de la Loire, avec des visites de châteaux viticoles et des degustations raffinees de vins locaux.', 367.00, 35, true),
	(1, 6, 5, 2, 3, 'Séjour vin et randonnee dans le vignoble', 'sejour64.jpg', 'Combinez randonnee a travers les vignobles et degustation de vins locaux lors de ce séjour sportif et oenologique.', 372.00, null, true),
	(3, 6, 13, 2, 4, 'Séjour oenologique a Saint-Emilion', 'sejour65.jpg', 'Un séjour exceptionnel a Saint-Emilion, avec des visites de châteaux et des degustations de vins prestigieux dans un cadre historique.', 683.00, 27, true),
	(4, 5, 11, 2, 1, 'Séjour decouverte des vins de l''Aude', 'sejour67.jpg', 'Un séjour dans l''Aude, pour decouvrir les vins de la region, avec des visites de caves et des activites en plein air dans un cadre naturel.', 711.50, null, true),
	(4, 5, 8, 3, 3, 'Séjour en famille dans les vignobles de la Loire', 'sejour68.jpg', 'Un séjour familial avec des activites pour enfants et des degustations pour adultes, tout en explorant les vignobles de la vallee de la Loire.', 462.00, 13, true),
	(4, 6, 11, 1, 2, 'Séjour oenologique et sportif', 'sejour69.jpg', 'Pour les passionnes de sport et de vin, ce séjour combine des activites en plein air et des degustations de vins locaux dans des lieux pittoresques.', 684.00, null, true),
	(4, 2, 10, 2, 1, 'Séjour a la decouverte des vins du Medoc', 'sejour70.jpg', 'Partez a la decouverte des grands crus du Medoc, avec des visites de châteaux historiques et des degustations raffinees.', 598.00, 16, true),
	(2, 5, 9, 3, 4, 'Séjour decouverte de la viticulture biologique', 'sejour71.jpg', 'Un séjour pour les passionnes de vins bio, avec des visites de domaines ecoresponsables et des degustations de vins bio.', 160.00, null, true),
	(1, 1, 9, 3, 3, 'Séjour bien-être et vins de la Vallee du Rhône', 'sejour72.jpg', 'Un séjour alliant bien-être, detente et decouverte des vins du Rhône, avec des soins au spa et des degustations dans un cadre enchanteur.', 354.50, null, true),
	(3, 4, 10, 1, 2, 'Séjour au domaine viticole en Champagne', 'sejour73.jpg', 'Venez decouvrir les secrets de la production du champagne et goûter les meilleurs crus de la region lors de ce séjour exclusif.', 302.00, 17, true),
	(2, 4, 7, 1, 1, 'Séjour decouverte de l''oenotourisme en Languedoc', 'sejour74.jpg', 'Un séjour pour les passionnes d''oenotourisme, avec des visites guidees des meilleurs domaines viticoles du Languedoc et des degustations variees.', 217.00, null, true),
	(1, 6, 7, 2, 4, 'Séjour decouverte des cepages rares', 'sejour75.jpg', 'Un séjour pour les connaisseurs de vins rares, avec des visites de domaines produisant des cepages peu connus et des degustations inedites.', 512.00, null, true),
	(1, 6, 2, 3, 3, 'Séjour autour des vins du Roussillon', 'sejour76.jpg', 'Partez a la decouverte des vins du Roussillon, avec des visites de domaines viticoles et des degustations au coeur des montagnes.', 357.00, null, true),
	(4, 5, 2, 1, 2, 'Séjour oenologique a Sancerre', 'sejour77.jpg', 'Un séjour dans la celebre region viticole de Sancerre, avec des degustations de vins blancs et des visites guidees des plus grands domaines.', 362.00, null, true),
	(1, 2, 12, 3, 4, 'Séjour viticole en Bourgogne', 'sejour78.jpg', 'Explorez la Bourgogne a travers ses vignobles prestigieux, avec des visites de domaines et des degustations des plus grands crus.', 228.00, 21, true),
	(4, 5, 2, 3, 1, 'Séjour en toute intimite a Montagne de Reims', 'sejour79.jpg', 'Sejournez dans un cadre intime et prestigieux a Montagne de Reims, avec des degustations de champagne et des visites privees de caves.', 236.00, null, true),
	(4, 2, 2, 1, 3, 'Séjour decouverte des vins de la Vallee du Tarn', 'sejour80.jpg', 'Venez decouvrir les vins du Tarn, avec des visites de vignobles authentiques et des degustations dans un cadre naturel et preserve.', 619.50, 29, true),
	(1, 2, 8, 3, 2, 'Séjour oenologique en Côtes de Provence', 'sejour81.jpg', 'Un séjour de rêve en Provence pour decouvrir les vins roses, avec des visites de domaines et des repas gastronomiques dans un cadre idyllique.', 313.00, 14, true),
	(3, 2, 14, 3, 4, 'Séjour vin et art de vivre en Alsace', 'sejour82.jpg', 'Un séjour unique où se mêlent la degustation de vins d''Alsace et la decouverte de l''art de vivre de cette magnifique region.', 167.00, 31, true),
	(4, 6, 7, 2, 1, 'Séjour viticole et sportif dans le Languedoc', 'sejour83.jpg', 'Combinez randonnee et degustation de vins dans la region du Languedoc, avec des visites de domaines viticoles au coeur de la nature.', 494.00, null, true),
	(1, 4, 8, 1, 3, 'Séjour aux portes de la Champagne', 'sejour84.jpg', 'Un séjour au coeur de la Champagne, avec des degustations privees de champagnes et des visites des celebres maisons de la region.', 571.00, 15, true),
	(3, 2, 8, 3, 2, 'Séjour gourmand et viticole en Provence', 'sejour85.jpg', 'Venez savourer les vins de Provence tout en profitant des delices gastronomiques locaux dans un cadre exceptionnel entre mer et vignes.', 625.50, 15, true),
	(4, 2, 12, 2, 4, 'Séjour au château de Pommard', 'sejour86.jpg', 'Sejournez dans le prestigieux château de Pommard, avec des visites privees et des degustations de vins fins accompagnees de repas raffines.', 320.00, 22, true),
	(3, 6, 11, 2, 1, 'Séjour vin et nature en Haute-Loire', 'sejour87.jpg', 'Sejournez en Haute-Loire et decouvrez la beaute des paysages viticoles, avec des randonnees et des degustations de vins locaux.', 749.00, null, true),
	(4, 1, 14, 1, 3, 'Séjour oenotourisme dans le Medoc', 'sejour88.jpg', 'Partez a la decouverte du Medoc, une region viticole d''exception, avec des visites de grands châteaux et des degustations exclusives.', 721.00, 32, true),
	(1, 5, 14, 3, 2, 'Séjour decouverte des vins du Sud-Ouest', 'sejour89.jpg', 'Un séjour dans le Sud-Ouest pour explorer ses vins uniques, avec des visites de caves et des degustations en plein coeur de la region.', 650.00, 33, true),
	(2, 5, 1, 2, 4, 'Séjour autour du vin et des traditions en Provence', 'sejour90.jpg', 'Un séjour en Provence pour decouvrir les traditions viticoles locales a travers des visites de caves et des degustations de vins regionaux.', 455.00, null, true),
	(1, 4, 14, 2, 1, 'Séjour viticole en Côtes de Nuits', 'sejour91.jpg', 'Sejournez dans la region des Côtes de Nuits, celebre pour ses grands crus de Bourgogne, avec des visites de vignobles et des degustations exclusives.', 319.00, 34, true),
	(2, 1, 5, 3, 3, 'Séjour vin et nature dans le Languedoc', 'sejour92.jpg', 'Un séjour inoubliable dans les vignobles du Languedoc, alliant la decouverte des vins locaux a des activites en plein air dans un cadre naturel exceptionnel.', 474.00, 28, true),
	(3, 5, 10, 1, 4, 'Séjour au coeur des vignes de la Loire', 'sejour93.jpg', 'Un séjour dans la vallee de la Loire pour explorer ses vignobles et ses châteaux, avec des degustations de vins authentiques.', 541.00, 16, true),
	(3, 4, 4, 1, 2, 'Séjour vin et gastronomie a Nantes', 'sejour94.jpg', 'Un séjour a Nantes alliant decouverte des vins de la region et degustation des produits locaux dans un cadre gastronomique raffine.', 643.00, 9, true),
	(1, 3, 6, 1, 1, 'Séjour viticole et detente en Bourgogne', 'sejour95.jpg', 'Venez vous detendre en Bourgogne tout en decouvrant ses grands vins a travers des visites de domaines et des moments de relaxation au spa.', 702.00, 11, true),
	(4, 4, 9, 3, 4, 'Séjour vin et patrimoine a Dijon', 'sejour96.jpg', 'Sejournez a Dijon pour decouvrir le patrimoine historique de la ville tout en explorant les vignobles alentours et en degustant des vins locaux.', 372.00, null, true),
	(3, 3, 6, 1, 3, 'Séjour autour du vin et de l''histoire a Bordeaux', 'sejour97.jpg', 'Plongez dans l''histoire de Bordeaux a travers une visite de ses châteaux viticoles et une degustation de vins du patrimoine de la region.', 696.00, 10, true),
	(4, 4, 8, 1, 2, 'Séjour vin et paysages en Alsace', 'sejour98.jpg', 'Un séjour dans les vignes d''Alsace pour decouvrir les vins de la region et profiter des paysages a couper le souffle.', 777.00, 13, true),
	(4, 4, 8, 3, 1, 'Séjour decouverte des grands vins de Bourgogne', 'sejour99.jpg', 'Un séjour a la decouverte des grands vins de Bourgogne, avec des visites de celebres domaines viticoles et des degustations de vins prestigieux.', 312.00, 12, true),
	(2, 2, 12, 3, 4, 'Séjour de luxe en Côtes du Rhône', 'sejour100.jpg', 'Un séjour de luxe dans la region des Côtes du Rhône, avec des visites privees et des degustations de vins d''exception dans des châteaux historiques.', 687.00, 23, true);

------------------------------------------------- FAVORIS
INSERT INTO
	Favoris (idClient, idSejour)
VALUES
	(25, 25),
	(17, 90),
	(2, 71),
	(6, 82),
	(7, 60),
	(35, 80),
	(43, 30),
	(49, 14),
	(36, 53),
	(8, 44),
	(44, 27),
	(42, 57),
	(12, 46),
	(3, 58),
	(48, 9),
	(23, 11),
	(45, 65),
	(16, 29),
	(21, 19),
	(46, 34),
	(4, 79),
	(40, 37),
	(13, 10),
	(33, 7),
	(18, 40),
	(41, 41),
	(14, 15),
	(27, 23),
	(30, 72),
	(32, 91),
	(26, 78),
	(1, 13),
	(39, 4),
	(28, 43),
	(20, 1),
	(9, 83),
	(38, 50),
	(19, 74),
	(15, 59),
	(31, 69),
	(29, 66),
	(47, 49),
	(37, 86),
	(24, 95),
	(10, 8),
	(34, 64),
	(11, 73),
	(22, 28),
	(5, 61);

------------------------------------------------- PANIER
INSERT INTO
	Panier (dateHeurePanier)
VALUES
	('2025-03-25 12:45'),
	('2025-01-25 08:37'),
	('2024-12-24 11:35'),
	('2024-10-24 21:04'),
	('2025-07-25 12:31'),
	('2025-07-25 08:55'),
	('2023-12-23 23:38'),
	('2024-06-24 11:39'),
	('2025-08-25 02:41'),
	('2024-08-24 13:31'),
	('2024-12-24 20:53'),
	('2025-07-25 02:59'),
	('2024-08-24 20:24'),
	('2024-06-24 03:59'),
	('2024-11-24 04:41'),
	('2024-04-24 05:14'),
	('2024-03-24 02:16'),
	('2025-10-25 14:07'),
	('2025-01-25 04:25'),
	('2024-09-24 08:14'),
	('2024-12-24 06:34'),
	('2024-02-24 12:45'),
	('2024-12-24 00:38'),
	('2024-09-24 00:06'),
	('2025-11-25 04:49'),
	('2023-12-23 22:57'),
	('2023-10-23 17:47'),
	('2025-05-25 15:48'),
	('2025-04-25 09:43'),
	('2025-10-25 04:35'),
	('2025-02-25 20:00'),
	('2025-04-25 04:21'),
	('2025-01-25 22:42'),
	('2024-05-24 17:58'),
	('2024-11-24 13:39'),
	('2025-04-25 08:15'),
	('2025-06-25 00:00'),
	('2023-11-23 02:24'),
	('2025-11-25 00:48'),
	('2025-09-25 00:04'),
	('2024-07-24 23:51'),
	('2025-11-25 00:13'),
	('2025-07-25 14:49'),
	('2024-03-24 22:22'),
	('2024-04-24 00:04'),
	('2024-07-24 03:14'),
	('2025-08-25 21:47'),
	('2025-07-25 17:14'),
	('2025-03-25 00:47'),
	('2023-11-23 17:03'),
	('2024-11-24 05:43'),
	('2024-09-24 10:46'),
	('2025-04-25 04:04'),
	('2025-09-25 16:09'),
	('2025-11-25 18:25'),
	('2024-02-24 07:00'),
	('2024-11-24 07:43'),
	('2025-10-25 00:46'),
	('2025-07-25 03:22'),
	('2025-07-25 00:34'),
	('2023-11-23 09:50'),
	('2025-09-25 15:08'),
	('2025-01-25 18:02'),
	('2024-11-24 04:24'),
	('2024-03-24 06:40'),
	('2025-08-25 14:00'),
	('2024-05-24 07:45'),
	('2025-06-25 10:49'),
	('2024-04-24 19:32'),
	('2025-05-25 10:43'),
	('2025-11-25 21:24'),
	('2024-05-24 07:22'),
	('2025-02-25 11:25'),
	('2025-08-25 23:06'),
	('2024-10-24 05:29'),
	('2024-02-24 09:59'),
	('2025-02-25 06:18'),
	('2025-10-25 00:54'),
	('2025-10-25 15:08'),
	('2025-04-25 20:10'),
	('2024-01-24 21:03'),
	('2024-05-24 08:11'),
	('2025-04-25 05:17'),
	('2024-03-24 11:54'),
	('2025-02-25 19:57'),
	('2025-02-25 12:00'),
	('2025-05-25 09:33'),
	('2025-06-25 05:58'),
	('2023-12-23 17:59'),
	('2023-12-23 20:49'),
	('2024-07-24 10:43'),
	('2024-12-24 11:13'),
	('2024-11-24 03:58'),
	('2023-12-23 14:47'),
	('2024-01-24 05:24'),
	('2025-03-25 18:02'),
	('2023-11-23 17:13'),
	('2025-07-25 05:27'),
	('2025-01-25 00:11'),
	('2024-12-24 18:53'),
	('2023-11-23 01:59'),
	('2024-06-24 00:46'),
	('2025-06-25 15:49'),
	('2024-09-24 21:33'),
	('2025-05-25 17:33'),
	('2024-05-24 14:35'),
	('2025-10-25 18:20'),
	('2024-04-24 20:09'),
	('2023-11-23 06:51'),
	('2024-09-24 09:25'),
	('2024-04-24 12:59'),
	('2025-07-25 14:01'),
	('2025-04-25 18:48'),
	('2024-09-24 07:57'),
	('2024-06-24 06:20'),
	('2025-11-25 16:40'),
	('2025-01-25 23:25'),
	('2024-06-24 15:46'),
	('2025-10-25 18:38'),
	('2024-07-24 12:17'),
	('2024-02-24 08:53'),
	('2025-03-25 00:50'),
	('2024-01-24 02:10'),
	('2025-03-25 11:55'),
	('2025-03-25 07:46'),
	('2024-06-24 17:19'),
	('2025-03-25 07:35'),
	('2025-05-25 00:34'),
	('2024-07-24 03:30'),
	('2023-12-23 20:48'),
	('2024-10-24 22:00'),
	('2024-03-24 07:41'),
	('2024-09-24 00:24'),
	('2024-12-24 14:22'),
	('2025-08-25 10:07'),
	('2024-07-24 07:03'),
	('2023-11-23 13:29'),
	('2025-10-25 04:16'),
	('2025-02-25 13:31'),
	('2023-11-23 13:22'),
	('2025-03-25 09:44'),
	('2024-10-24 04:58'),
	('2024-12-24 15:29'),
	('2025-01-25 16:32'),
	('2025-01-25 21:24'),
	('2025-09-25 10:35'),
	('2025-06-25 10:28'),
	('2023-12-23 09:15'),
	('2023-11-23 08:45'),
	('2025-02-25 17:15');

------------------------------------------------- COMMANDE
INSERT INTO
	commande (idClientAcheteur,idcb, idClientBeneficiaire, idAdresseFacturation, idAdresseLivraison, idPanier, codeReduction, typePaiementCommande, dateCommande, etatCommande)
VALUES
	(31,1,27,30, 11, 110,null,'cb', '2024-06-05', 'Paiement validé'),
	(11,null,31,1, 31, 112,null,'stripe', '2024-07-21', 'En attente de validation'),
	(35,null,11,24, 36, 116,null,'stripe', '2024-08-23', 'Paiement refusé'),
	(19,null,18,45, 45, 96,null,'paypal', '2024-11-30', 'Paiement validé'),
	(49,null,12,26, 8, 81,null,'stripe', '2024-08-12', 'En attente de validation'),
	(1,1,45,36, 7, 128,null,'cb', '2024-03-02', 'En attente de validation'),
	(46,null,6,22, 19, 105,null,'paypal', '2024-03-06', 'Paiement validé'),
	(44,null,49,14, 13, 96,null,'stripe', '2024-07-23', 'En attente de validation'),
	(20,null,42,38, 24, 3,null,'paypal', '2024-09-22', 'Paiement validé'),
	(53,1,5,27, 49, 62,null,'cb', '2024-09-11', 'Paiement validé'),
	(13,null,2,42, 25, 5,null,'stripe', '2024-01-14', 'Paiement refusé'),
	(33,null,23,23, 46, 124,null,'paypal', '2024-11-25', 'Paiement validé'),
	(17,null,48,5, 21, 12,null,'paypal', '2024-07-30', 'En attente de validation'),
	(14,1,12,3, 5, 55,null,'cb', '2024-06-05', 'Paiement validé'),
	(36,null,12,6, 42, 3,null,'stripe', '2024-09-03', 'En attente de validation'),
	(27,null,30,7, 20, 100,null,'paypal', '2024-11-18', 'Paiement refusé'),
	(12,null,47,16, 16, 48,null,'paypal', '2024-10-26', 'En attente de validation'),
	(16,1,28,29, 43, 21,null,'cb', '2024-10-01', 'Annulé'),
	(5,null,2,11, 22, 26,null,'paypal', '2024-09-29', 'En attente de validation'),
	(25,null,36,25, 44, 120,null,'paypal', '2024-05-05', 'Paiement validé'),
	(15,null,30,39, 38, 67,null,'stripe', '2024-04-25', 'Paiement validé'),
	(41,1,8,40, 27, 144,null,'cb', '2024-01-02', 'En attente de validation'),
	(53,null,3,4, 41, 138,null,'stripe', '2024-08-15', 'Paiement validé'),
	(6,null,12,15, 35, 85,null,'paypal', '2024-05-29', 'En attente de validation'),
	(40,1,46,34, 23, 139,null,'cb', '2024-03-21', 'Annulé'),
	(8,null,14,2, 50, 69,null,'paypal', '2024-08-14', 'En attente de validation'),
	(22,null,38,12, 1, 21,null,'stripe', '2024-10-16', 'Paiement refusé'),
	(21,1,7,44, 26, 118,null,'cb', '2024-04-12', 'Paiement validé'),
	(30,null,14,21, 39, 17,null,'paypal', '2024-11-07', 'Annulé'),
	(48,null,29,10, 28, 40,null,'paypal', '2024-04-24', 'En attente de validation'),
	(4,1,18,37, 4, 100,null,'cb', '2024-09-03', 'Annulé'),
	(47,null,43,13, 10, 84,null,'paypal', '2024-09-04', 'En attente de validation'),
	(28,1,10,17, 14, 44,null,'cb', '2024-11-16', 'Paiement validé'),
	(43,1,2,49, 37, 130,null,'cb', '2024-12-05', 'En attente de validation'),
	(7,null,29,33, 33, 39,null,'stripe', '2024-08-17', 'En attente de validation'),
	(2,1,38,8, 3, 37,null,'cb', '2024-04-08', 'Paiement refusé'),
	(53,null,22,9, 12, 101,null,'stripe', '2024-07-15', 'En attente de validation'),
	(38,1,19,31, 29, 33,null,'cb', '2024-01-18', 'Paiement refusé'),
	(3,null,27,41, 32, 145,null,'stripe', '2024-12-06', 'En attente de validation'),
	(32,1,6,32, 15, 75,null,'cb', '2024-11-28', 'Paiement refusé'),
	(9,1,44,50, 9, 62,null,'cb', '2024-07-17', 'En attente de validation'),
	(10,null,20,35, 40, 32,null,'paypal', '2024-07-31', 'Paiement validé'),
	(26,1,34,19, 30, 1,null,'cb', '2023-12-22', 'Paiement refusé'),
	(53,null,32,48, 6, 85,null,'paypal', '2024-08-27', 'Paiement refusé'),
	(18,null,19,47, 17, 28,null,'stripe', '2024-01-17', 'En attente de validation'),
	(42,null,15,46, 48, 7,null,'paypal', '2024-07-17', 'Paiement refusé'),
	(29,1,10,43, 2, 76,null,'cb', '2024-11-27', 'Paiement validé'),
	(22,null,33,20, 34, 47,null,'paypal', '2024-06-25', 'Annulé'),
	(35,null,24,18, 18, 13,null,'stripe', '2024-12-02', 'Paiement validé'),
	(53,1,27,28, 47, 51,null,'cb', '2024-03-29', 'Paiement refusé'),
	(53,null,null,52,null,51,'mqSMIluinZv','cb','2024-03-25','En attente de validation');

------------------------------------------------- ACTIVITE
INSERT INTO
	ACTIVITE (libelleActivite, PRIXACTIVITE)
VALUES
	('Survol en montgolfiere', 60),
	('Excursions en velo ou a pied', 40),
	('Spas et bien-être', 50),
	('Excursions en 4x4 ou en voiture de collection', 110);

------------------------------------------------- CAVE
INSERT INTO
    CAVE (idPartenaire, idTypeDegustation, nomPartenaire, mailPartenaire, telPartenaire)
VALUES
    (36,6, 'La Cave des Vins Raffines', 'contact@vinsraffines.com', '0145678901'),
    (37,1, 'Caveau des Grands Crus', 'info@caveaugrandscrus.com', '0156789012'),
    (38,2, 'Le Cellier des epicuriens', 'contact@cellier-epicuriens.com', '0167890123'),
    (39,6, 'Cave des Coteaux', 'reservation@cave-coteaux.com', '0178901234'),
    (40,10, 'La Cave de la Vigne d''Or', 'info@cavedelavigneor.com', '0189012345'),
    (41,2, 'Le Vieux Cellier', 'contact@vieuxcellier.com', '0190123456'),
    (42,2, 'Les Vins du Terroir', 'contact@vinsduterroir.com', '0201234567'),
    (43,6, 'Cave du château de la Loire', 'info@caveloire.com', '0212345678'),
    (44,8, 'La Caverne des Vins Precieux', 'reservation@cavernedesvins.com', '0223456789'),
    (45,9, 'Le Cellier de l''Abbaye', 'contact@cellierabbaye.com', '0234567890'),
    (46,9, 'La Cave des Vins du Terroir', 'contact@cavevinsterroir.com', '0245678901'),
    (47,7, 'Les Secrets de la Cave', 'info@secretsdelacave.com', '0256789012'),
    (48,6, 'Le Domaine des Vins Gourmets', 'contact@domainevinsgourmets.com', '0267890123'),
    (49,1, 'Les Caves de l''Hermitage', 'contact@caveshermitage.com', '0278901234'),
    (50,8, 'Le Cellier des Sommeliers', 'info@cellier-sommeliers.com', '0289012345');

------------------------------------------------- TYPE CUISINE
INSERT INTO
	TYPECUISINE (libelleTypeCuisine)
VALUES
	('Cuisine Italienne'),
	('Cuisine Française'),
	('Cuisine Japonaise'),
	('Cuisine Mexicaine'),
	('Cuisine Espagnole'),
	('Cuisine Chinoise'),
	('Cuisine Indienne'),
	('Cuisine Thaïlandaise'),
	('Cuisine Marocaine'),
	('Cuisine Grecque');

------------------------------------------------- RESTAURANT
INSERT INTO
	RESTAURANT (idPartenaire,idTypeCuisine, nomPartenaire, mailPartenaire, telPartenaire, nombreEtoilesRestaurant, specialiteRestaurant)
VALUES
	(1,1,'Le Gourmet de Paris', 'contact@gourmetparis.com', '0145678901', 5, 'Cuisine Française Gastronomique'),
	(2,6,'Le Jardin d''epicure', 'info@jardinepicure.com', '0156789012', 4, 'Cuisine Mediterraneenne'),
	(3,2,'L''Auberge de la Côte', 'contact@aubergelacote.com', '0167890123', 3, 'Poissons et Fruits de Mer'),
	(4,3,'La Table de Monsieur Paul', 'reservation@tablepaul.com', '0178901234', 5, 'Cuisine Française Traditionnelle'),
	(5,1,'Le Ristorante Bella Vita', 'info@bellavita.com', '0189012345', 4, 'Cuisine Italienne'),
	(6,2,'Chez Antoine', 'contact@chezantoine.com', '0190123456', 3, 'Cuisine provençale'),
	(7,2,'Le Bistrot de la Mer', 'contact@bistrotmer.com', '0201234567', 4, 'Poissons et Fruits de Mer'),
	(8,6,'Le château des Saveurs', 'info@chateausaveurs.com', '0212345678', 5, 'Cuisine Française elaboree'),
	(9,6,'La Brasserie du Parc', 'contact@brasserieparc.com', '0223456789', 3, 'Cuisine Française et Brasserie'),
	(10,1,'Le Cordon Bleu', 'contact@cordonbleu.com', '0234567890', 5, 'Haute Cuisine Française'),
	(11,1,'Le Cafe de la Paix', 'reservation@cafepai.com', '0245678901', 4, 'Cuisine Française et Brasserie'),
	(12,10,'L''Assiette Gourmande', 'info@assiettegourmande.com', '0256789012', 4, 'Cuisine Française Moderne'),
	(13,4,'Le Petit Bistro du Vieux Lyon', 'contact@petitbistrolyon.com', '0267890123', 3, 'Cuisine Lyonnaise'),
	(14,9,'La Table d''Helene', 'reservation@tablehelene.com', '0278901234', 4, 'Cuisine Française Creative'),
	(15,10,'Le Gourmet Voyageur', 'contact@gourmetvoyageur.com', '0289012345', 5, 'Cuisine Fusion Internationale');

------------------------------------------------- HOTEL
INSERT INTO
	HOTEL (idPartenaire,nomPartenaire, mailPartenaire, telPartenaire, nombreChambresHotel, categorieHotel)
VALUES
	(16,'Hôtel Le Meridien', 'contact@meridienhotel.com', '0148567890', 150, 5),
	(17,'Hôtel des Arts', 'info@hotelarts.com', '0156789012', 85, 4),
	(18,'Luxe & Nature Resort', 'reservation@luxenature.com', '0167890123', 200, 5),
	(19,'Auberge de la Vallee', 'contact@aubergelavallee.com', '0178901234', 45, 3),
	(20,'Hotel Grand Paris', 'info@grandparishotel.com', '0189012345', 120, 4),
	(21,'Hôtel Le château Blanc', 'info@chateaublanc.com', '0190123456', 100, 4),
	(22,'Le Riviera Hôtel', 'reservation@riviera-hotel.com', '0201234567', 70, 3),
	(23,'Hôtel Le Cloître', 'contact@lecloitrehotel.com', '0212345678', 50, 3),
	(24,'Palace Hôtel des Dunes', 'info@palace-dunes.com', '0223456789', 250, 5),
	(25,'Hôtel Les etoiles de Provence', 'reservation@etoilesprovence.com', '0234567890', 90, 4);

------------------------------------------------- AUTRE SOCIETE
INSERT INTO
	AUTRESOCIETE (idPartenaire,nomPartenaire, mailPartenaire, telPartenaire)
VALUES
	(26,'Domaine du Vieux Lavoir', 'contact@vieuxlavoir.com', '0623456789'),
	(27,'château de la Vigne', 'info@chateau-vigne.com', '0712345678'),
	(28,'Le Clos des Vins de la Montagne', 'contact@closvinsmontagne.com', '0634598765'),
	(29,'Domaine de la Terre Promise', 'contact@terrepromise.com', '0611122334'),
	(30,'Vin et Voyage', 'contact@vinvoyage.com', '0723456987'),
	(31,'Les Vins du Soleil', 'info@vinsdusoleil.com', '0689123456'),
	(32,'Domaine du château d''Or', 'contact@chateau-or.com', '0756789012'),
	(33,'La Maison des Vins', 'contact@maisondesvins.com', '0623456890'),
	(34,'Les Vins de la Cite', 'info@vinsdelacite.com', '0678901234'),
	(35,'Caveau des Millesimes', 'contact@caveaumillesimes.com', '0654321098');

------------------------------------------------- HEBERGEMENT
INSERT INTO
	HEBERGEMENT (idPartenaire, PRIXHEBERGEMENT, descriptionHebergement, photoHebergement, lienHebergement)
VALUES
	(16, 104.50, 'Séjournez dans un domaine viticole avec vue panoramique sur les vignes et profitez de la tranquillite d''un cadre naturel exceptionnel.', 'domaine_viticole_vue_panoramique.jpg', 'https://www.vinotrip.com/fr/partenaires/211-hotel-rocaminori'),
	(17, 88.20, 'Un château authentique entoure de parc paysager, offrant une experience unique de luxe et de detente au coeur des vignes.', 'chateau_parc.jpg', 'https://www.vinotrip.com/fr/partenaires/8-maison-olivier-leflaive'),
	(18, 121.75, 'Un gîte spacieux dans une maison traditionnelle de vigneron, avec terrasse privee pour savourer les produits locaux.', 'gite_rural_vigneron.jpg', 'https://www.vinotrip.com/fr/partenaires/231-la-dryade'),
	(19, 93.10, 'Chambres d''hôtes chaleureuses dans une maison en pierre, au coeur du vignoble, pour un séjour authentique et convivial.', 'chambres_hotes_pierre.jpg', 'https://www.vinotrip.com/fr/partenaires/55-hostellerie-de-levernois'),
	(20, 112.45, 'Loft moderne avec vue sur les vignes et acces direct aux caves pour une immersion complete dans le monde du vin.', 'loft_modernes_caves.jpg', 'https://www.vinotrip.com/fr/partenaires/23-maison-prosper-maufoux'),
	(21, 79.60, 'Vivez une experience unique en séjournant dans une tente safari de luxe, alliant confort et immersion en pleine nature.', 'tente_safari_luxe.jpg', 'https://www.vinotrip.com/fr/partenaires/177-chateau-haut-bailly'),
	(22, 99.99, 'Séjournez dans une maison de maître du XVIIIe siecle avec piscine chauffee et jardins, a quelques pas des vignes.', 'maison_maitre_piscine.jpg', 'https://www.vinotrip.com/fr/partenaires/178-hostellerie-le-cedre'),
	(23, 119.30, 'Séjournez dans un hôtel spa 5 etoiles avec une cave a vin d''exception et un service sur-mesure pour les amateurs de vin.', 'hotel_spa_cave_vin.jpg', 'https://www.vinotrip.com/fr/partenaires/121-hostellerie-la-briqueterie'),
	(24, 106.80, 'Demeure historique au charme intemporel, proposant des cours de cuisine gastronomique accompagnes de degustations de vins.', 'demeure_historique_cuisine.jpg', 'https://www.vinotrip.com/fr/partenaires/123-domaine-du-prieure-saint-agnan'),
	(25, 113.15, 'Hôtel de charme avec un restaurant gastronomique, où chaque plat est accompagne d''un vin local soigneusement selectionne.', 'hotel_charme_restaurant.jpg', 'https://www.vinotrip.com/fr/partenaires/44-chateau-du-tertre'),
	(21, 80.75, 'Mobil-home confortable et moderne situe dans un parc viticole, avec terrasse et activites de degustation de vins a proximite.', 'mobil_home_parc_viticole.jpg', 'https://www.vinotrip.com/fr/partenaires/164-les-sources-de-caudalie'),
	(22, 101.55, 'Appartement cosy dans un vignoble familial, ideal pour decouvrir les secrets de la viticulture et profiter des produits locaux.', 'appartement_vignoble_familial.jpg', 'https://www.vinotrip.com/fr/partenaires/42-golf-du-medoc'),
	(23, 123.00, 'Bungalow sur pilotis avec terrasse privee pour admirer les vignes et les paysages environnants en toute tranquillite.', 'bungalow_pilotis_terrasse.jpg', 'https://www.vinotrip.com/fr/partenaires/230-le-clos-de-la-tuiliere'),
	(24, 91.40, 'Un hebergement ecoresponsable en plein coeur du vignoble, conçu avec des materiaux ecologiques et offrant un confort optimal.', 'hebergement_ecologique_vignoble.jpg', 'https://www.vinotrip.com/fr/partenaires/202-la-bastide-saint-bach'),
	(25, 110.60, 'Cabane dans les arbres perchee au-dessus du vignoble, avec une vue imprenable pour un séjour insolite et romantique.', 'cabane_arbre_vignes.jpg', 'https://www.vinotrip.com/fr/partenaires/81-chateau-de-la-romaningue');

------------------------------------------------- REPAS
INSERT INTO
	REPAS (idPartenaire, PRIXREPAS, descriptionRepas, photoRepas)
VALUES
	(9, 27.50, 'Degustation de mets locaux accompagnes de vins de la region, pour une immersion complete dans la gastronomie du terroir.', 'degustation_mets_locaux.jpg'),
	(5, 41.00, 'Menu gastronomique avec accord mets et vins, mettant en valeur les produits du terroir et les grands crus locaux.', 'menu_gastronomique_vins.jpg'),
	(13, 22.50, 'Repas traditionnel avec des specialites regionales, cuisinees avec des produits frais du marche local.', 'repas_traditionnel_specialites.jpg'),
	(14, 35.00, 'Dîner sous les etoiles dans un vignoble, avec un repas aux saveurs mediterraneennes accompagne de vins bio.', 'diner_sous_etoiles_vignoble.jpg'),
	(4, 50.00, 'Brunch compose de viennoiseries artisanales, de charcuteries fines et de fromages locaux, parfait pour bien commencer la journee.', 'brunch_viennoiseries_charcuteries.jpg'),
	(12, 38.00, 'Dejeuner en terrasse avec des produits de saison : salades, viandes grillees et desserts maison, tout accompagne de vins de la maison.', 'dejeuner_terrasse_produits_saison.jpg'),
	(15, 29.00, 'Repas vegetarien gastronomique avec des vins bio, pour decouvrir une cuisine saine et savoureuse en accord avec la nature.', 'repas_vegetarien_gastronomique.jpg'),
	(8, 45.00, 'Degustation de foie gras accompagne de chutneys maison et d''un vin moelleux, une experience delicate et raffinee.', 'degustation_foie_gras_chutney.jpg'),
	(12, 33.50, 'Dîner de fruits de mer frais, avec un assortiment de crustaces et de coquillages, accompagne d''un vin blanc sec et fruite.', 'diner_fruits_de_mer.jpg'),
	(13, 31.00, 'Repas autour du vin, avec une serie de petites bouchees creatives et des accords mets-vins surprenants, pour une experience gustative unique.', 'repas_accords_mets_vins.jpg'),
	(5, 24.00, 'Table d''hôte familiale, avec un repas copieux compose de viandes rôties, de legumes de saison et de desserts traditionnels.', 'table_hote_familiale_viande.jpg'),
	(7, 43.00, 'Repas de terroir dans une auberge authentique, avec un menu mettant en avant les produits du terroir et les vins locaux.', 'repas_terroir_auberge.jpg'),
	(6, 47.00, 'Dîner gourmet avec un chef etoile, proposant un menu degustation de plusieurs plats accompagnes de grands vins de la region.', 'diner_gourmet_chef_etoile.jpg'),
	(7, 32.00, 'Casse-croûte campagnard dans un cadre bucolique, avec des charcuteries, fromages et pain frais, a deguster avec un verre de vin local.', 'casse_croute_campagnard.jpg'),
	(5, 23.00, 'Repas festif avec un barbecue de viandes grillees, salades variees et vins rouges puissants pour accompagner le tout.', 'repas_festif_barbecue.jpg'),
	(10, 36.00, 'Degustation de fromages artisanaux, accompagnee d''une selection de vins affines, pour une experience gustative inoubliable.', 'degustation_fromages_vins.jpg'),
	(4, 49.00, 'Degustation de tapas accompagnees de vins effervescents locaux, pour une experience conviviale et festive.', 'degustation_tapas_vins_effervescents.jpg'),
	(1, 28.00, 'Menu de saison avec des legumes du jardin, des viandes elevees en plein air, et des vins rouges fins pour accompagner les plats.', 'menu_de_saison_legumes_viandes.jpg'),
	(1, 46.00, 'Repas italien avec pâtes fraîches maison, antipasti et fromages affines, accompagne d''un vin rouge italien fruite.', 'repas_italien_pates_antipasti.jpg'),
	(8, 30.00, 'Dîner romantique avec menu degustation de 5 plats, chaque plat etant accompagne d''un vin soigneusement selectionne.', 'diner_romantique_menu_5_plats.jpg'),
	(13, 44.00, 'Repas de fûte autour de l''agneau rôti, legumes de saison et gratin dauphinois, accompagne d''un vin rouge riche et complexe.', 'repas_fete_agneau_gratin.jpg'),
	(10, 48.00, 'Degustation de plats typiques de la region, tels que la bouillabaisse ou le cassoulet, accompagnee de vins regionaux.', 'degustation_bouillabaisse_cassoulet.jpg'),
	(10, 42.00, 'Pique-nique chic dans un parc ou un domaine viticole, avec des sandwiches gourmets, fromages, fruits frais et vins petillants.', 'pique_nique_chic_vins_petit.jpg'),
	(8, 39.00, 'Repas vegetalien avec des plats creatifs a base de legumes, cereales et legumineuses, accompagnes de vins blancs legers.', 'repas_vegetalien_creatif.jpg'),
	(6, 26.00, 'Dîner dans un restaurant au bord de l''eau, avec des fruits de mer, poissons frais et un verre de vin blanc mineral.', 'diner_bord_de_l_eau_fruits_mer.jpg'),
	(7, 34.50, 'Repas autour du canard, avec magret de canard rôti, puree de pommes de terre et vin rouge du terroir.', 'repas_canard_magret_puree.jpg'),
	(11, 25.00, 'Repas typique de la cuisine basque, avec axoa, pintxos et gâteau basque, le tout accompagne d''un vin local rouge.', 'repas_basque_axoa_pintxos.jpg'),
	(4, 40.00, 'Degustation de viandes en sauce (boeuf bourguignon, coq au vin), servies avec des pommes de terre fondantes et des vins rouges.', 'degustation_viandes_sauce.jpg'),
	(1, 21.00, 'Dîner autour de la truffe, avec des risottos, pâtes fraîches et omelette a la truffe, accompagnes d''un vin blanc elegant.', 'diner_truffe_risotto_omelette.jpg'),
	(1, 37.00, 'Repas de Noël avec dinde farcie, legumes rôtis et bûche de Noël, accompagne de vins rouges ou moelleux selon les plats.', 'repas_noel_dinde_buche.jpg');

------------------------------------------------- PROPOSE 4
INSERT INTO
	Propose_4 (idActivite, idPartenaire, idAdresse)
VALUES
	(2, 26, 32),
	(4, 27, 36),
	(1, 28, 48),
	(1, 29, 16),
	(1, 30, 28),
	(2, 31, 41),
	(4, 32, 4),
	(2, 33, 32),
	(1, 34, 44),
	(3, 35, 13);

------------------------------------------------- ETAPE
INSERT INTO
	ETAPE (idHebergement, idSejour, titreEtape, descriptionEtape, photoEtape, URLEtape, videoEtape)
VALUES
	(15, 1, 'Accueil a la cave', 'Bienvenue dans notre cave, où le voyage du vin commence avec une introduction a nos methodes de production.', 'photo_accueil.jpg', 'https://www.vinotrip.com/accueil-cave', 'https://youtu.be/dQw4w9WgXcQ?si=AI9ZFLtxFOHiYQxG'),
	(15, 2, 'Visite des vignes', 'Decouvrez nos vignes et apprenez-en davantage sur les cepages cultives dans notre region.', 'photo_vignes.jpg', 'https://www.vinotrip.com/visite-vignes', 'https://www.youtube.com/watch?v=def456'),
	(2, 3, 'Atelier de degustation', 'Participez a un atelier de degustation guide par un sommelier pour decouvrir les nuances de nos vins.', 'photo_degustation.jpg', 'https://www.vinotrip.com/atelier-degustation', 'https://www.youtube.com/watch?v=ghi789'),
	(12, 4, 'Degustation de vin rouge', 'Degustation exclusive de notre selection de vins rouges vieillissant en fûts de chêne.', 'photo_vin_rouge.jpg', 'https://www.vinotrip.com/degustation-vin-rouge', 'https://www.youtube.com/watch?v=jkl012'),
	(3, 5, 'Degustation de vin blanc', 'Savourez nos vins blancs frais, fruites et pleins de caractere.', 'photo_vin_blanc.jpg', 'https://www.vinotrip.com/degustation-vin-blanc', 'https://www.youtube.com/watch?v=mno345'),
	(1, 6, 'Degustation de vin rose', 'Appreciez la legerete et la finesse de nos vins roses, parfaits pour les journees ensoleillees.', 'photo_vin_rose.jpg', 'https://www.vinotrip.com/degustation-vin-rose', 'https://www.youtube.com/watch?v=pqr678'),
	(1, 7, 'Visite du chai', 'Explorez notre chai et decouvrez comment nous transformons le raisin en vin.', 'photo_chai.jpg', 'https://www.vinotrip.com/visite-chai', 'https://www.youtube.com/watch?v=stu901'),
	(14, 8, 'Rencontre avec le vigneron', 'echangez avec notre vigneron passionne pour en savoir plus sur son travail et ses choix de vinification.', 'photo_vigneron.jpg', 'https://www.vinotrip.com/rencontre-vigneron', 'https://www.youtube.com/watch?v=vwx234'),
	(4, 9, 'Dejeuner au domaine', 'Profitez d''un dejeuner gastronomique avec des accords mets et vins soigneusement selectionnes.', 'photo_dejeuner.jpg', 'https://www.vinotrip.com/dejeuner-au-domaine', 'https://youtu.be/TrntlVAGFmU?si=crVWX3xqQn_IwHMj'),
	(15, 10, 'Atelier accords mets et vins', 'Apprenez a associer nos meilleurs vins avec des mets raffines lors de cet atelier pratique.', 'photo_accrods_mets_vins.jpg', 'https://www.vinotrip.com/atelier-accords-mets-vins', 'https://www.youtube.com/watch?v=abc678'),
	(5, 11, 'Balade dans les vignes', 'Partez en balade dans nos vignes et decouvrez la nature qui donne naissance a nos vins.', 'photo_balade_vignes.jpg', 'https://www.vinotrip.com/balade-vignes', 'https://www.youtube.com/watch?v=def789'),
	(6, 12, 'Degustation des vins millesimes', 'Savourez des vins exceptionnels de differents millesimes, soigneusement selectionnes pour leur qualite.', 'photo_millesimes.jpg', 'https://www.vinotrip.com/degustation-vins-millesimes', 'https://www.youtube.com/watch?v=ghi890'),
	(10, 13, 'Visite guidee de la cave', 'Une visite guidee avec un expert pour tout savoir sur le processus de vinification.', 'photo_visite_cave.jpg', 'https://www.vinotrip.com/visite-guidee-cave', 'https://www.youtube.com/watch?v=jkl123'),
	(9, 14, 'Degustation de vins bio', 'Decouvrez notre gamme de vins bio, cultives sans pesticides et dans le respect de l''environnement.', 'photo_vin_bio.jpg', 'https://www.vinotrip.com/degustation-vins-bio', 'https://www.youtube.com/watch?v=mno234'),
	(15, 15, 'Atelier de fabrication du vin', 'Participez a un atelier interactif sur la fabrication du vin, de la vigne a la bouteille.', 'photo_fabrication_vin.jpg', 'https://www.vinotrip.com/atelier-fabrication-vin', 'https://www.youtube.com/watch?v=pqr345'),
	(3, 16, 'Degustation des grands crus', 'Goûtez nos grands crus, vinifies avec les meilleurs raisins de notre region.', 'photo_grands_crus.jpg', 'https://www.vinotrip.com/degustation-grands-crus', 'https://www.youtube.com/watch?v=stu456'),
	(4, 17, 'Degustation au coucher du soleil', 'Vivez une experience unique en degustant nos vins au coucher du soleil, avec une vue imprenable.', 'photo_coucher_soleil.jpg', 'https://www.vinotrip.com/degustation-coucher-soleil', 'https://www.youtube.com/watch?v=vwx567'),
	(1, 18, 'Visite en 4x4 des vignobles', 'Partez a l''aventure en 4x4 a travers nos vignobles pour decouvrir des lieux insolites.', 'photo_visite_4x4.jpg', 'https://www.vinotrip.com/visite-4x4-vignobles', 'https://www.youtube.com/watch?v=yzx678'),
	(15, 19, 'Seance de degustation privee', 'Reservez une degustation privee pour une experience sur mesure avec un sommelier.', 'photo_degustation_privee.jpg', 'https://www.vinotrip.com/degustation-privee', 'https://www.youtube.com/watch?v=abc789'),
	(2, 20, 'Degustation de vin et chocolat', 'Un mariage parfait entre nos vins et du chocolat haut de gamme.', 'photo_vin_chocolat.jpg', 'https://www.vinotrip.com/degustation-vin-chocolat', 'https://www.youtube.com/watch?v=def890'),
	(1, 21, 'Soiree a theme au domaine', 'Participez a une soiree conviviale avec des animations autour du vin et des produits locaux.', 'photo_soiree_theme.jpg', 'https://www.vinotrip.com/soiree-theme-domaine', 'https://www.youtube.com/watch?v=ghi012'),
	(13, 22, 'Degustation en plein air', 'Venez deguster nos vins au grand air, entoure de la beaute de la nature.', 'photo_degustation_plein_air.jpg', 'https://www.vinotrip.com/degustation-plein-air', 'https://www.youtube.com/watch?v=jkl234'),
	(2, 23, 'Atelier de cuisine et vin', 'Apprenez a cuisiner des plats locaux et decouvrez comment les associer a nos vins.', 'photo_atelier_cuisine.jpg', 'https://www.vinotrip.com/atelier-cuisine-vin', 'https://www.youtube.com/watch?v=mno345'),
	(15, 24, 'Degustation de vins rares', 'Venez decouvrir des vins rares et uniques, conserves dans nos caves.', 'photo_vins_rares.jpg', 'https://www.vinotrip.com/degustation-vins-rares', 'https://www.youtube.com/watch?v=pqr456'),
	(10, 25, 'Visite des caves souterraines', 'Explorez nos caves souterraines, où nos meilleurs vins sont conserves dans des conditions optimales.', 'photo_caves_souterraines.jpg', 'https://www.vinotrip.com/visite-caves-souterraines', 'https://www.youtube.com/watch?v=stu567'),
	(11, 26, 'Degustation des vins du domaine', 'Profitez d''une degustation de tous les vins produits sur notre domaine, du plus leger au plus complexe.', 'photo_vins_domaine.jpg', 'https://www.vinotrip.com/degustation-vins-domaine', 'https://youtu.be/XqZsoesa55w?si=qyTkZwIQ5cbifsuz'),
	(2, 27, 'Degustation en barriques', 'Venez decouvrir nos vins en vieillissement dans des barriques, et degustez-les directement de la cuve.', 'photo_vins_barriques.jpg', 'https://www.vinotrip.com/degustation-barriques', 'https://www.youtube.com/watch?v=yzx789'),
	(10, 28, 'Atelier d''assemblage des vins', 'Decouvrez le processus d''assemblage des vins et creez votre propre cuvee.', 'photo_assemblage_vins.jpg', 'https://www.vinotrip.com/atelier-assemblage-vins', 'https://www.youtube.com/watch?v=abc012'),
	(5, 29, 'Visite panoramique des vignes', 'Prenez de la hauteur avec une vue panoramique sur nos vignobles et apprenez-en plus sur nos methodes de culture.', 'photo_vue_vignes.jpg', 'https://www.vinotrip.com/visite-panorama-vignes', 'https://www.youtube.com/watch?v=def123'),
	(8, 30, 'Decouverte de l''histoire du vin', 'Plongez dans l''histoire fascinante du vin et de la viticulture a travers une exposition interactive.', 'photo_histoire_vin.jpg', 'https://www.vinotrip.com/histoire-du-vin', 'https://www.youtube.com/watch?v=ghi234'),
	(9, 31, 'Excursion en velo a travers les vignes', 'Venez decouvrir nos vignobles en velo electrique avec une guide locale.', 'photo_velo_vignes.jpg', 'https://www.vinotrip.com/excursion-velo-vignes', 'https://www.youtube.com/watch?v=jkl345'),
	(1, 32, 'Visite d''un vignoble bio', 'Visitez un vignoble certifie bio et decouvrez les pratiques agricoles respectueuses de l''environnement.', 'photo_vignoble_bio.jpg', 'https://www.vinotrip.com/vignoble-bio', 'https://www.youtube.com/watch?v=mno456'),
	(9, 33, 'Apero degustation en terrasse', 'Profitez d''un aperitif convivial en terrasse avec une selection de nos meilleurs vins.', 'photo_aperitif_terrasse.jpg', 'https://www.vinotrip.com/aperitif-terrasse', 'https://www.youtube.com/watch?v=pqr567'),
	(10, 34, 'Dîner avec accord mets et vins', 'Un dîner gastronomique où chaque plat est soigneusement accorde avec l''un de nos vins.', 'photo_diner_accords.jpg', 'https://www.vinotrip.com/diner-accords-mets-vins', 'https://www.youtube.com/watch?v=stu678'),
	(7, 35, 'Seance de yoga dans les vignes', 'Detendez-vous et profitez de la nature lors d''une seance de yoga en plein air dans nos vignes.', 'photo_yoga_vignes.jpg', 'https://www.vinotrip.com/yoga-dans-vignes', 'https://www.youtube.com/watch?v=vwx789'),
	(1, 36, 'Rencontre avec un artisan du vin', 'Rencontrez un artisan du vin et decouvrez son savoir-faire dans la creation de vins uniques.', 'photo_artisan_vin.jpg', 'https://www.vinotrip.com/rencontre-artisan-vin', 'https://www.youtube.com/watch?v=yzx890'),
	(8, 37, 'Visite des caves a vin modernes', 'Explorez nos caves a vin modernes, où tradition et innovation se rencontrent pour produire des vins exceptionnels.', 'photo_caves_modernes.jpg', 'https://www.vinotrip.com/visite-caves-modernes', 'https://www.youtube.com/watch?v=abc678'),
	(2, 38, 'Degustation de vin dans le parc', 'Participez a une degustation dans le parc du domaine, entoure par la beaute de la nature.', 'photo_degustation_parc.jpg', 'https://www.vinotrip.com/degustation-parc', 'https://www.youtube.com/watch?v=def789'),
	(1, 39, 'Atelier sur les arômes du vin', 'Apprenez a reconnaître les arômes subtils des vins grâce a un atelier interactif.', 'photo_aromes_vin.jpg', 'https://www.vinotrip.com/atelier-aromes-vin', 'https://www.youtube.com/watch?v=ghi012'),
	(15, 40, 'Degustation de vins et fromage', 'Associez nos vins avec une selection de fromages affines pour une experience gastronomique unique.', 'photo_vin_fromage.jpg', 'https://www.vinotrip.com/degustation-vin-fromage', 'https://www.youtube.com/watch?v=jkl345'),
	(5, 41, 'Soiree cinema en plein air', 'Profitez d''une soiree cinema en plein air sur notre domaine, avec une selection de films sur le vin.', 'photo_soiree_cinema.jpg', 'https://www.vinotrip.com/soiree-cinema-vin', 'https://www.youtube.com/watch?v=mno678'),
	(14, 42, 'Randonnee oenologique', 'Partez en randonnee dans nos collines et apprenez-en plus sur la viticulture et le terroir.', 'photo_randonnee_oenologique.jpg', 'https://www.vinotrip.com/randonnee-oenologique', 'https://www.youtube.com/watch?v=pqr901'),
	(7, 43, 'Degustation de vin et tapas', 'Savourez une selection de tapas accompagnee de nos vins les plus reputes.', 'photo_tapas_vin.jpg', 'https://www.vinotrip.com/degustation-tapas-vin', 'https://www.youtube.com/watch?v=stu234'),
	(9, 44, 'Visite du domaine en petit train', 'Visitez notre domaine en petit train et decouvrez les secrets de la production viticole.', 'photo_train_domaine.jpg', 'https://www.vinotrip.com/visite-petit-train', 'https://www.youtube.com/watch?v=vwx012'),
	(13, 45, 'Atelier sur la vinification', 'Participez a un atelier où vous apprendrez toutes les etapes de la vinification, de la recolte a la mise en bouteille.', 'photo_vinification.jpg', 'https://www.vinotrip.com/atelier-vinification', 'https://www.youtube.com/watch?v=yzx123'),
	(5, 46, 'Degustation de vins de garde', 'Decouvrez les vins de garde de notre domaine, qui s''ameliorent avec l''âge.', 'photo_vins_de_garde.jpg', 'https://www.vinotrip.com/degustation-vins-de-garde', 'https://www.youtube.com/watch?v=abc345'),
	(4, 47, 'Visite privee du domaine', 'Profitez d''une visite privee sur notre domaine, avec un guide expert qui vous devoilera tous les secrets du vin.', 'photo_visite_privee.jpg', 'https://www.vinotrip.com/visite-privee-domaine', 'https://www.youtube.com/watch?v=def012'),
	(11, 48, 'Degustation de vin en barrique', 'Decouvrez la maturation de nos vins en barriques et degustez-les directement du fût.', 'photo_vins_barrique.jpg', 'https://www.vinotrip.com/degustation-vins-barrique', 'https://www.youtube.com/watch?v=ghi456'),
	(3, 49, 'Atelier de cuisine avec un chef', 'Apprenez a cuisiner des plats locaux avec un chef tout en decouvrant comment les associer a nos vins.', 'photo_cuisine_chef.jpg', 'https://www.vinotrip.com/atelier-cuisine-chef', 'https://www.youtube.com/watch?v=jkl567'),
	(11, 50, 'Degustation au coeur des vignes', 'Venez deguster nos vins en pleine nature, au coeur même de nos vignes.', 'photo_degustation_coeur_vignes.jpg', 'https://www.vinotrip.com/degustation-coeur-vignes', 'https://www.youtube.com/watch?v=mno789'),
	(13, 51, 'Visite des installations de vinification', 'Decouvrez les installations de vinification dernier cri de notre domaine et apprenez comment nos vins sont produits.', 'photo_installations_vinification.jpg', 'https://www.vinotrip.com/visite-installations-vinification', 'https://www.youtube.com/watch?v=pqr123'),
	(15, 52, 'Degustation et visites nocturnes', 'Venez vivre une experience unique en degustant nos vins lors d''une visite nocturne du domaine.', 'photo_degustation_nocturne.jpg', 'https://www.vinotrip.com/degustation-visite-nocturne', 'https://www.youtube.com/watch?v=stu789'),
	(2, 53, 'Soiree musicale et degustation', 'Participez a une soiree musicale autour du vin avec des performances en live.', 'photo_soiree_musicale.jpg', 'https://www.vinotrip.com/soiree-musicale-vin', 'https://www.youtube.com/watch?v=vwx234'),
	(3, 54, 'Balade oenologique a cheval', 'Decouvrez notre vignoble d''une maniere originale lors d''une balade a cheval entre les vignes.', 'photo_balade_cheval.jpg', 'https://www.vinotrip.com/balade-oenologique-cheval', 'https://www.youtube.com/watch?v=yzx012'),
	(13, 55, 'Degustation de vins fruites', 'Venez savourer une selection de vins fruites et legers, parfaits pour les journees estivales.', 'photo_vins_fruites.jpg', 'https://www.vinotrip.com/degustation-vins-fruites', 'https://www.youtube.com/watch?v=abc678'),
	(8, 56, 'Visite a pied du domaine', 'Partez en balade a pied a travers notre domaine et decouvrez ses paysages a couper le souffle.', 'photo_visite_pied.jpg', 'https://www.vinotrip.com/visite-pied-domaine', 'https://www.youtube.com/watch?v=def234'),
	(10, 57, 'Atelier d''apprentissage des cepages', 'Apprenez a reconnaître les differents cepages cultives sur notre domaine grâce a un atelier interactif.', 'photo_cepages.jpg', 'https://www.vinotrip.com/atelier-apprentissage-cepages', 'https://www.youtube.com/watch?v=ghi345'),
	(15, 58, 'Degustation de vins en musique', 'Profitez d''une degustation accompagnee de musique live pour une experience sensorielle complete.', 'photo_vins_musique.jpg', 'https://www.vinotrip.com/degustation-vins-musique', 'https://www.youtube.com/watch?v=jkl678'),
	(3, 59, 'Dîner en exterieur avec accords mets-vins', 'Savourez un dîner sous les etoiles avec des accords mets-vins adaptes a chaque plat.', 'photo_diner_exterieur.jpg', 'https://www.vinotrip.com/diner-accords-exterieur', 'https://www.youtube.com/watch?v=mno234'),
	(15, 60, 'Visite d''un vignoble historique', 'Decouvrez un vignoble historique et apprenez l''histoire de la region viticole.', 'photo_vignoble_historique.jpg', 'https://www.vinotrip.com/visite-vignoble-historique', 'https://www.youtube.com/watch?v=pqr567'),
	(8, 61, 'Degustation de vins effervescents', 'Venez savourer nos vins effervescents, parfaits pour celebrer chaque occasion speciale.', 'photo_vins_effervescents.jpg', 'https://www.vinotrip.com/degustation-vins-effervescents', 'https://www.youtube.com/watch?v=stu678'),
	(15, 62, 'Visite de la cave a barriques', 'Explorez notre cave a barriques et decouvrez les secrets du vieillissement en fût.', 'photo_cave_barriques.jpg', 'https://www.vinotrip.com/visite-cave-barriques', 'https://www.youtube.com/watch?v=vwx890'),
	(3, 63, 'Atelier decouverte des arômes', 'Apprenez a identifier les arômes dans nos vins et a mieux comprendre leurs nuances.', 'photo_aromes_decouverte.jpg', 'https://www.vinotrip.com/atelier-decouverte-aromes', 'https://www.youtube.com/watch?v=yzx123'),
	(1, 64, 'Pique-nique au domaine', 'Profitez d''un pique-nique dans notre domaine, accompagne de nos vins les plus apprecies.', 'photo_pique_nique.jpg', 'https://www.vinotrip.com/pique-nique-domaine', 'https://www.youtube.com/watch?v=abc234'),
	(4, 65, 'Decouverte du processus de vendange', 'Participez a une experience de vendange et apprenez comment nous recoltons les raisins.', 'photo_vendange.jpg', 'https://www.vinotrip.com/decouverte-vendange', 'https://www.youtube.com/watch?v=def567'),
	(15, 66, 'Degustation de vins et foie gras', 'Associez nos meilleurs vins avec du foie gras pour une experience gastronomique raffinee.', 'photo_foie_gras_vin.jpg', 'https://www.vinotrip.com/degustation-foie-gras-vin', 'https://www.youtube.com/watch?v=ghi012'),
	(10, 67, 'Atelier d''art floral et vin', 'Creez un arrangement floral tout en degustant nos vins, une experience alliant art et oenologie.', 'photo_art_floral_vin.jpg', 'https://www.vinotrip.com/atelier-art-floral-vin', 'https://www.youtube.com/watch?v=jkl901'),
	(4, 68, 'Degustation de vins et charcuterie', 'Savourez une selection de charcuteries artisanales accompagnee de nos meilleurs vins.', 'photo_charcuterie_vin.jpg', 'https://www.vinotrip.com/degustation-charcuterie-vin', 'https://www.youtube.com/watch?v=mno789'),
	(5, 69, 'Visite du domaine en segway', 'Decouvrez notre domaine en segway et profitez d''une visite originale et ludique.', 'photo_seguey_domaine.jpg', 'https://www.vinotrip.com/visite-segway-domaine', 'https://www.youtube.com/watch?v=pqr678'),
	(14, 70, 'Degustation de vins en barrique', 'Goûtez nos vins directement depuis les barriques et apprenez tout sur leur vieillissement.', 'photo_vins_barriques_2.jpg', 'https://www.vinotrip.com/degustation-vins-barriques-2', 'https://www.youtube.com/watch?v=stu890'),
	(12, 71, 'Atelier sur les vins naturels', 'Participez a un atelier où vous decouvrirez les vins naturels, produits sans sulfites ajoutes.', 'photo_vins_naturels.jpg', 'https://www.vinotrip.com/atelier-vins-naturels', 'https://www.youtube.com/watch?v=vwx345'),
	(14, 72, 'Degustation de vins avec vue sur les montagnes', 'Savourez nos vins tout en admirant une vue imprenable sur les montagnes environnantes.', 'photo_vins_montagne.jpg', 'https://www.vinotrip.com/degustation-vins-montagne', 'https://www.youtube.com/watch?v=yzx678'),
	(3, 73, 'Visite d''un vignoble bio et rencontre avec le vigneron', 'Visitez un vignoble bio et discutez avec le vigneron des defis et des recompenses de l''agriculture durable.', 'photo_vignoble_bio_2.jpg', 'https://www.vinotrip.com/visite-vignoble-bio-rencontre-vigneron', 'https://www.youtube.com/watch?v=abc890'),
	(6, 74, 'Atelier de cuisine et degustation', 'Apprenez a cuisiner un plat typique tout en decouvrant comment le marier avec nos vins.', 'photo_cuisine_vins.jpg', 'https://www.vinotrip.com/atelier-cuisine-degustation', 'https://www.youtube.com/watch?v=def012'),
	(7, 75, 'Seance de degustation a l''aveugle', 'Testez vos competences en degustation en participant a une seance a l''aveugle.', 'photo_degustation_aveugle.jpg', 'https://www.vinotrip.com/degustation-aveugle', 'https://www.youtube.com/watch?v=ghi678'),
	(8, 76, 'Degustation de vins locaux', 'Decouvrez notre gamme de vins locaux, produits sur place et representatifs de notre terroir.', 'photo_vins_locaux.jpg', 'https://www.vinotrip.com/degustation-vins-locaux', 'https://www.youtube.com/watch?v=jkl123'),
	(4, 77, 'Atelier decouverte des cepages locaux', 'Venez decouvrir les cepages locaux cultives sur notre domaine et apprenez tout sur leur specificite.', 'photo_cepages_locaux.jpg', 'https://www.vinotrip.com/atelier-decouverte-cepages-locaux', 'https://www.youtube.com/watch?v=mno234'),
	(1, 78, 'Degustation de vins et tapas espagnols', 'Associez nos vins avec des tapas typiques de la cuisine espagnole pour une experience pleine de saveurs.', 'photo_tapas_espagnols.jpg', 'https://www.vinotrip.com/degustation-tapas-espagnols', 'https://www.youtube.com/watch?v=pqr345'),
	(15, 79, 'Visite a velo electrique des vignobles', 'Decouvrez notre vignoble en velo electrique, une façon ecologique et agreable de parcourir nos terres.', 'photo_velo_electrique_vignes.jpg', 'https://www.vinotrip.com/visite-velo-electrique-vignobles', 'https://www.youtube.com/watch?v=stu567'),
	(2, 80, 'Degustation de vin et specialites italiennes', 'Associez nos vins avec une selection de specialites italiennes pour une degustation inoubliable.', 'photo_vins_italiens.jpg', 'https://www.vinotrip.com/degustation-vins-italiens', 'https://www.youtube.com/watch?v=vwx678'),
	(7, 81, 'Exploration des caves historiques', 'Decouvrez l''histoire fascinante de nos caves historiques, datant de plusieurs siecles.', 'photo_caves_historiques.jpg', 'https://www.vinotrip.com/exploration-caves-historiques', 'https://www.youtube.com/watch?v=wxyz123'),
	(11, 82, 'Balade dans les oliveraies', 'Visitez nos oliveraies et apprenez-en plus sur la culture de l''olive et son influence sur le vin.', 'photo_oliveraies.jpg', 'https://www.vinotrip.com/balade-oliveraies', 'https://www.youtube.com/watch?v=abc123'),
	(13, 83, 'Degustation de vins effervescents', 'Goûtez nos vins effervescents elabores selon la methode traditionnelle.', 'photo_vins_effervescents.jpg', 'https://www.vinotrip.com/degustation-vins-effervescents', 'https://www.youtube.com/watch?v=xyz456'),
	(12, 84, 'Dîner avec le vigneron', 'Participez a un dîner intime avec le vigneron pour discuter de l''art de la vinification et de ses vins.', 'photo_diner_vigneron.jpg', 'https://www.vinotrip.com/diner-avec-le-vigneron', 'https://www.youtube.com/watch?v=uvw789'),
	(10, 85, 'Atelier de degustation sensorielle', 'Affinez vos sens avec un atelier de degustation qui explore les arômes et saveurs du vin.', 'photo_atelier_sensoriel.jpg', 'https://www.vinotrip.com/atelier-degustation-sensorielle', 'https://www.youtube.com/watch?v=rst987'),
	(3, 86, 'Decouverte des cepages locaux', 'Parcourez nos vignobles pour decouvrir les cepages locaux qui composent nos vins uniques.', 'photo_cepages_locaux.jpg', 'https://www.vinotrip.com/decouverte-cepages-locaux', 'https://www.youtube.com/watch?v=ijk012'),
	(9, 87, 'Seance photo dans les vignes', 'Capturez des souvenirs avec une seance photo professionnelle au coeur de nos vignobles.', 'photo_seance_photo.jpg', 'https://www.vinotrip.com/seance-photo-vignes', 'https://www.youtube.com/watch?v=opq456'),
	(2, 88, 'Rencontre avec le maître de chai', 'echangez avec notre maître de chai pour comprendre les secrets du vieillissement du vin.', 'photo_rencontre_chai.jpg', 'https://www.vinotrip.com/rencontre-maitre-chai', 'https://www.youtube.com/watch?v=lmn123'),
	(12, 89, 'Excursion en 4x4 a travers les vignobles', 'Explorez les vignes en 4x4 et accedez a des panoramas inaccessibles a pied.', 'photo_visite_4x4_vignoble.jpg', 'https://www.vinotrip.com/excursion-4x4-vignobles', 'https://www.youtube.com/watch?v=xyz789'),
	(5, 90, 'Degustation de vins en barrique', 'Goûtez nos vins directement en barrique et decouvrez l''evolution des arômes au fil du temps.', 'photo_degustation_barrique.jpg', 'https://www.vinotrip.com/degustation-vins-barrique', 'https://www.youtube.com/watch?v=stu654'),
	(2, 91, 'Degustation des vins du domaine', 'Decouvrez l''ensemble de nos vins, du plus jeune au plus vieux, en une degustation complete.', 'photo_vins_domaine.jpg', 'https://www.vinotrip.com/degustation-vins-domaine', 'https://www.youtube.com/watch?v=ab1c2d3'),
	(6, 92, 'Visite guidee en jeep des vignobles', 'Explorez nos vignobles en jeep tout terrain et apprenez l''histoire de notre domaine.', 'photo_jeep_vignobles.jpg', 'https://www.vinotrip.com/visite-jeep-vignobles', 'https://www.youtube.com/watch?v=ef4g5h6'),
	(1, 93, 'Degustation en cave troglodyte', 'Venez deguster nos vins dans une cave troglodyte creusee dans la roche, une experience unique.', 'photo_cave_troglodyte.jpg', 'https://www.vinotrip.com/degustation-cave-troglodyte', 'https://www.youtube.com/watch?v=ijk456'),
	(11, 94, 'Atelier de creation de cuvee', 'Creez votre propre cuvee en choisissant les cepages et le style de vin que vous preferez.', 'photo_creation_cuvee.jpg', 'https://www.vinotrip.com/atelier-creation-cuvee', 'https://www.youtube.com/watch?v=lmn789'),
	(3, 95, 'Degustation a l''aveugle', 'Mettez vos sens a l''epreuve avec une degustation a l''aveugle de nos meilleurs crus.', 'photo_degustation_aveugle.jpg', 'https://www.vinotrip.com/degustation-aveugle', 'https://www.youtube.com/watch?v=pqr123'),
	(14, 96, 'Cuisinez avec un chef local', 'Participez a un atelier de cuisine avec un chef local et apprenez a marier vos plats avec nos vins.', 'photo_cuisine_chef_local.jpg', 'https://www.vinotrip.com/cuisine-avec-chef-local', 'https://www.youtube.com/watch?v=stu890'),
	(8, 97, 'Visite des vignobles en helicoptere', 'Survolez nos vignobles en helicoptere et admirez les paysages a couper le souffle.', 'photo_helicoptere_vignobles.jpg', 'https://www.vinotrip.com/visite-helicoptere-vignobles', 'https://www.youtube.com/watch?v=xyz012'),
	(3, 98, 'Degustation de vins et fromage', 'Appreciez la delicieuse association de nos vins avec une selection de fromages artisanaux.', 'photo_vins_fromage.jpg', 'https://www.vinotrip.com/degustation-vins-fromage', 'https://www.youtube.com/watch?v=abc345'),
	(8, 99, 'Visite des vignes en velo electrique', 'Faites un tour de nos vignobles a velo electrique pour une experience ecologique et relaxante.', 'photo_velo_electrique.jpg', 'https://www.vinotrip.com/visite-vignes-velo-electrique', 'https://www.youtube.com/watch?v=efg678'),
	(1, 100, 'Atelier de fabrication de vin', 'Decouvrez les etapes de la fabrication du vin, de la vigne a la bouteille, lors d''un atelier pratique.', 'photo_fabrication_vin.jpg', 'https://www.vinotrip.com/atelier-fabrication-vin', 'https://www.youtube.com/watch?v=hij789'),
	(4, 38, 'Seance de yoga dans les vignes', 'Venez pratiquer le yoga en pleine nature, entoure par les vignes, pour une experience de bien-être unique.', 'photo_yoga_vignes.jpg', 'https://www.vinotrip.com/yoga-vignes', 'https://www.youtube.com/watch?v=klm123'),
	(13, 52, 'Dîner dans les vignes', 'Savourez un dîner gastronomique sous les etoiles, en plein coeur des vignes.', 'photo_diner_vignes.jpg', 'https://www.vinotrip.com/diner-dans-les-vignes', 'https://www.youtube.com/watch?v=nop456'),
	(11, 50, 'Visite nocturne des caves', 'Partez a la decouverte des caves de nuit et vivez une experience magique sous eclairage tamise.', 'photo_visite_nocturne.jpg', 'https://www.vinotrip.com/visite-nocturne-caves', 'https://www.youtube.com/watch?v=stu567'),
	(4, 26, 'Atelier de peinture et vin', 'Laissez libre cours a votre creativite en participant a un atelier de peinture tout en degustant nos vins.', 'photo_peinture_vin.jpg', 'https://www.vinotrip.com/atelier-peinture-vin', 'https://www.youtube.com/watch?v=uvw890'),
	(5, 53, 'Survol en montgolfiere au lever du soleil', 'Volez au lever du soleil en montgolfiere pour une vue spectaculaire sur les vignes.', 'photo_montgolfiere_soleil.jpg', 'https://www.vinotrip.com/survol-montgolfiere-soleil', 'https://www.youtube.com/watch?v=wxy123'),
	(4, 36, 'Decouverte des vins biodynamiques', 'Apprenez tout sur la viticulture biodynamique et degustez des vins issus de ce mode de culture.', 'photo_vins_biodynamiques.jpg', 'https://www.vinotrip.com/degustation-vins-biodynamiques', 'https://www.youtube.com/watch?v=xyz345'),
	(10, 10, 'Excursion a velo a travers les champs de lavande', 'Venez explorer les champs de lavande a velo, une experience sensorielle unique en son genre.', 'photo_velo_lavande.jpg', 'https://www.vinotrip.com/excursion-velo-lavande', 'https://www.youtube.com/watch?v=abc678'),
	(11, 75, 'Atelier degustation de chocolats et vins', 'Savourez des chocolats artisanaux en harmonie avec nos vins pour une degustation unique.', 'photo_chocolats_vins.jpg', 'https://www.vinotrip.com/degustation-chocolats-vins', 'https://www.youtube.com/watch?v=ghi123'),
	(14, 75, 'Cave a vin interactive', 'Venez decouvrir une cave interactive où vous pourrez deguster des vins et decouvrir leur histoire.', 'photo_cave_interactive.jpg', 'https://www.vinotrip.com/cave-interactive', 'https://www.youtube.com/watch?v=ijk567'),
	(13, 94, 'Seance de meditation dans les vignes', 'Profitez d''une seance de meditation au coeur des vignes, un moment de calme et de serenite.', 'photo_meditation_vignes.jpg', 'https://www.vinotrip.com/meditation-vignes', 'https://www.youtube.com/watch?v=lmn890'),
	(15, 9, 'Excursion dans les montagnes pour la production de vin', 'Partez en randonnee jusqu''aux montagnes pour decouvrir les methodes de culture des raisins en altitude.', 'photo_excursion_montagne_vins.jpg', 'https://www.vinotrip.com/excursion-montagnes-vins', 'https://www.youtube.com/watch?v=opq123'),
	(7, 50, 'Visite d''une distillerie de vin', 'Visitez une distillerie specialisee dans la production de vins de qualite superieure et de spiritueux.', 'photo_distillerie_vins.jpg', 'https://www.vinotrip.com/visite-distillerie-vins', 'https://www.youtube.com/watch?v=rst456'),
	(13, 41, 'Degustation en plein air sous les arbres', 'Savourez nos vins dans un cadre champêtre, a l''ombre des arbres, tout en profitant de la nature.', 'photo_degustation_plein_air.jpg', 'https://www.vinotrip.com/degustation-plein-air', 'https://www.youtube.com/watch?v=uvw789'),
	(9, 22, 'Excursion a pied sur les chemins des vignes', 'Partez en randonnee a travers les plus beaux chemins de vignes, en pleine nature.', 'photo_rando_vignes.jpg', 'https://www.vinotrip.com/rando-chemins-vignes', 'https://www.youtube.com/watch?v=xyz234'),
	(4, 18, 'Decouverte des vins effervescents artisanaux', 'Goûtez a des vins effervescents produits artisanalement dans notre domaine viticole.', 'photo_vins_effervescents_artisanaux.jpg', 'https://www.vinotrip.com/degustation-vins-effervescents-artisanaux', 'https://www.youtube.com/watch?v=abc890'),
	(9, 5, 'Cuisinez avec des produits du terroir', 'Apprenez a cuisiner des plats locaux avec des produits frais et de saison, en accord avec nos vins.', 'photo_cuisine_terroir.jpg', 'https://www.vinotrip.com/cuisine-produits-terroir', 'https://www.youtube.com/watch?v=efg234');

------------------------------------------------- VISITE
INSERT INTO
	VISITE (idPartenaire, descriptionVisite, photoVisite, lienvisite)
VALUES
	(36, 'Visite guidee d''un domaine viticole familial, avec decouverte des methodes de vinification et degustation de vins blancs et rouges.', 'visite_domaine_familial_vigneron.jpg', 'https://www.vinotrip.com/fr/partenaires/20-chateau-de-corton-andre'),
	(37, 'Parcours pedestre a travers les vignes, suivi d''une degustation en cave avec le vigneron pour decouvrir les secrets de son terroir.', 'parcours_vignes_degustation.jpg', 'https://www.vinotrip.com/fr/partenaires/23-maison-prosper-maufoux'),
	(38, 'Visite d''une cave historique avec une exposition sur l''histoire du vin, suivie d''une degustation de millesimes rares.', 'cave_historique_exposition_vins.jpg', 'https://www.vinotrip.com/fr/partenaires/51-domaine-du-comte-senard'),
	(39, 'Decouverte des coulisses d''une maison de champagne, avec une visite des caves souterraines et une degustation de champagnes millesimes.', 'visite_cave_champagne_millesime.jpg', 'https://www.vinotrip.com/fr/partenaires/8-maison-olivier-leflaive'),
	(40, 'Visite d''un chai traditionnel avec demonstration de la fabrication du vin, suivie d''une degustation des dernieres cuvees.', 'visite_chai_traditionnel.jpg', 'https://www.vinotrip.com/fr/partenaires/156-domaine-debray'),
	(41, 'Excursion dans les vignes en 4x4, suivie d''une degustation de vins locaux accompagnee de produits du terroir.', 'excursion_4x4_vignes_degustation.jpg', 'https://www.vinotrip.com/fr/partenaires/251-chateau-tifayne'),
	(42, 'Visite guidee d''un domaine bio, où l''on vous explique les methodes de culture biodynamiques et les caracteristiques des vins produits.', 'visite_domaine_bio_biodynamie.jpg', 'https://www.vinotrip.com/fr/partenaires/227-chateau-des-bachelards'),
	(43, 'Decouverte des secrets de la vinification, avec un atelier pratique où vous apprendrez a creer votre propre assemblage de vin.', 'atelier_creation_vin.jpg', 'https://www.vinotrip.com/fr/partenaires/189-domaine-de-la-ville-rouge'),
	(44, 'Visite de vignobles en terrasses, avec une vue imprenable sur la vallee, suivie d''une degustation de vins typiques de la region.', 'vignobles_terrasses_vue_vallee.jpg', 'https://www.vinotrip.com/fr/partenaires/225-chateau-de-la-chaize'),
	(45, 'Visite d''une ferme viticole où l''on cultive des raisins et des produits artisanaux, avec une degustation de produits locaux.', 'ferme_viticole_degustation_produits.jpg', 'https://www.vinotrip.com/fr/partenaires/120-domaine-de-castellane'),
	(46, 'Promenade dans les vignes avec un guide local qui vous expliquera les particularites du terroir et des cepages cultives.', 'promenade_vignes_guide_local.jpg', 'https://www.vinotrip.com/fr/partenaires/219-champagne-le-gallais'),
	(47, 'Visite d''un musee du vin avec des expositions interactives, suivie d''une degustation commentee de differents types de vins.', 'visite_musee_du_vin_exposition.jpg', 'https://www.vinotrip.com/fr/partenaires/226-champagne-mercier'),
	(48, 'Tour guide dans une region viticole classee au patrimoine mondial de l''UNESCO, avec un arrêt dans un domaine prestigieux pour une degustation.', 'tour_region_viticole_unesco.jpg', 'https://www.vinotrip.com/fr/partenaires/252-maison-hotes-ilot-vignes'),
	(49, 'Decouverte d''un domaine viticole avec un atelier sensoriel pour apprendre a reconnaître les arômes et saveurs des vins.', 'atelier_sensoriel_vins_aromes.jpg', 'https://www.vinotrip.com/fr/partenaires/248-domaine-gueguen'),
	(50, 'Balade a velo a travers les vignobles, suivie d''une degustation de vins et de produits locaux dans une cave conviviale.', 'balade_velo_vignoble_degustation.jpg', 'https://www.vinotrip.com/fr/partenaires/253-maison-cabotte'),
	(46, 'Visite guidee d''un domaine vinicole avec une degustation de vins de prestige et une presentation des techniques de taille de la vigne.', 'visite_domaine_vins_prestige.jpg', 'https://www.vinotrip.com/fr/partenaires/25-domaine-trapet'),
	(47, 'Excursion en bateau sur un lac entoure de vignes, suivie d''une degustation de vins locaux et de fromages artisanaux.', 'excursion_bateau_lac_vignes.jpg', 'https://www.vinotrip.com/fr/partenaires/246-chateau-des-faures'),
	(48, 'Visite d''une cave troglodyte, creusee dans la roche, avec une explication des techniques ancestrales de vinification.', 'visite_cave_troglodyte_techniques.jpg', 'https://www.vinotrip.com/fr/partenaires/223-maison-regnard'),
	(49, 'Visite d''un domaine viticole avec degustation de vins rares et explication sur l''elevage en fût de chêne.', 'visite_domaine_vins_rares_futs.jpg', 'https://www.vinotrip.com/fr/partenaires/15-domaine-manuel-olivie),r'),
	(50, 'Visite d''un domaine viticole en biodynamie, avec une degustation de vins en accord avec des mets locaux, pour decouvrir les synergies des saveurs.', 'visite_biodynamie_vins_mets.jpg', 'https://www.vinotrip.com/fr/partenaires/80-chateau-soutard');

------------------------------------------------- APPARTIENT 4
INSERT INTO
	APPARTIENT_4 (idEtape, idActivite)
VALUES
	(1, 3),
	(2, 3),
	(3, 2),
	(4, 2),
	(5, 3),
	(6, 4),
	(7, 4),
	(8, 3),
	(9, 3),
	(10, 4),
	(11, 1),
	(12, 3),
	(13, 2),
	(14, 4),
	(15, 4),
	(16, 1),
	(17, 3),
	(18, 3),
	(19, 1),
	(20, 4),
	(21, 1),
	(22, 4),
	(23, 3),
	(24, 4),
	(25, 2),
	(26, 2),
	(27, 4),
	(28, 4),
	(29, 2),
	(30, 1),
	(31, 4),
	(32, 3),
	(33, 4),
	(34, 4),
	(35, 1),
	(36, 2),
	(37, 1),
	(38, 2),
	(39, 1),
	(40, 3),
	(41, 3),
	(42, 1),
	(43, 1),
	(44, 3),
	(45, 2),
	(46, 4),
	(47, 4),
	(48, 3),
	(49, 2),
	(50, 2),
	(51, 2),
	(52, 4),
	(53, 2),
	(54, 3),
	(55, 4),
	(56, 4),
	(57, 3),
	(58, 1),
	(59, 2),
	(60, 4),
	(61, 3),
	(62, 3),
	(63, 2),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 3),
	(69, 1),
	(70, 1),
	(71, 3),
	(72, 4),
	(73, 2),
	(74, 3),
	(75, 4),
	(76, 2),
	(77, 2),
	(78, 3),
	(79, 3),
	(80, 4),
	(81, 3),
	(82, 2),
	(83, 3),
	(84, 4),
	(85, 4),
	(86, 1),
	(87, 3),
	(88, 3),
	(89, 1),
	(90, 3),
	(91, 4),
	(92, 4),
	(93, 4),
	(94, 2),
	(95, 2),
	(96, 1),
	(97, 4),
	(98, 1),
	(99, 1),
	(100, 2),
	(89, 4),
	(68, 1),
	(8, 4),
	(16, 4),
	(97, 3),
	(55, 3),
	(15, 1),
	(46, 3),
	(85, 3),
	(29, 1),
	(39, 2),
	(6, 1),
	(58, 2),
	(35, 2),
	(41, 1),
	(50, 3),
	(16, 3),
	(25, 4),
	(4, 4),
	(41, 2),
	(9, 4),
	(54, 1),
	(40, 4),
	(12, 4),
	(31, 3),
	(19, 2),
	(53, 1),
	(22, 3),
	(91, 3),
	(13, 1),
	(72, 3),
	(72, 2),
	(97, 2),
	(96, 4),
	(49, 3),
	(80, 1),
	(83, 2),
	(42, 3),
	(92, 3),
	(35, 3),
	(62, 4),
	(10, 3),
	(36, 4),
	(12, 1),
	(67, 3),
	(1, 1),
	(67, 4),
	(28, 3),
	(76, 3),
	(60, 1);

------------------------------------------------- AVIS
INSERT INTO
	avis (idClient, idSejour, titreAvis, dateAvis, descriptionAvis, noteAvis)
VALUES
	(40, 24, 'Super experience', '2024-11-05', 'Un séjour vraiment agreable, avec des visites de vignobles exceptionnelles. Le guide etait tres professionnel.', 5),
	(10, 93, 'Un moment inoubliable', '2024-10-30', 'Un cadre magnifique et une equipe passionnee. Les vins etaient excellents et la degustation top!', 5),
	(46, 2, 'A refaire', '2024-10-28', 'J''ai beaucoup apprecie la visite, bien que la degustation ait ete un peu courte.', 4),
	(31, 31, 'Degustation mediocre', '2024-10-25', 'Je m''attendais a mieux. Les vins etaient assez ordinaires, pas beaucoup de choix.', 2),
	(23, 92, 'Decevant', '2024-10-22', 'Le service n''etait pas a la hauteur de mes attentes. Trop de monde et pas assez d''explication.', 3),
	(6, 55, 'Excellente journee', '2024-10-20', 'Une excellente journee dans un domaine magnifique. Je recommande a tous les amateurs de vin.', 5),
	(10, 56, 'Tres bon séjour', '2024-10-18', 'L''accueil etait chaleureux et la visite tres bien orchestree. a recommander!', 4),
	(31, 52, 'Belle decouverte', '2024-10-15', 'Decouverte de vins peu connus, mais tres interessants. Bonne ambiance.', 4),
	(26, 1, 'Visite agreable', '2024-10-10', 'La visite des vignes etait instructive et agreable, mais la degustation manquait un peu de diversite.', 3),
	(2, 3, 'Moment sympa', '2024-10-08', 'Sympathique, mais l''activite etait un peu trop touristique a mon goût.', 3),
	(35, 98, 'Un cadre idyllique', '2024-10-06', 'Superbe domaine, magnifique vue et les vins etaient delicieux. Un moment parfait.', 5),
	(4, 33, 'Pas a la hauteur', '2024-10-02', 'Je m''attendais a mieux pour le prix, un peu deçu par l''organisation et la qualite des vins.', 2),
	(20, 86, 'Tres bonne visite', '2024-09-30', 'Une belle decouverte de l''univers du vin, avec un guide passionne. Je recommande vivement.', 5),
	(10, 48, 'Un peu cher', '2024-09-28', 'Les vins etaient bons, mais je trouve l''experience un peu chere pour ce qu''elle propose.', 3),
	(20, 89, 'Un agreable moment', '2024-09-25', 'Degustation interessante avec des vins de qualite. L''endroit etait charmant.', 4),
	(28, 37, 'A ne pas manquer', '2024-09-22', 'Une visite vraiment agreable avec des explications completes. Je recommande pour un groupe d''amis.', 5),
	(5, 51, 'Tres bon accueil', '2024-09-20', 'L''accueil etait excellent, la visite bien organisee et les vins au top. Tres satisfait.', 5),
	(16, 37, 'Bonne experience', '2024-09-17', 'Visite agreable, mais un peu rapide. Les vins etaient bons, mais sans plus.', 4),
	(35, 93, 'Tres bonne degustation', '2024-09-14', 'Degustation de tres bons vins, on sent la passion des vignerons. J''ai beaucoup aime!', 5),
	(5, 63, 'Moyenne', '2024-09-10', 'Je suis un peu mitige. Le cadre est joli, mais la degustation manque d''explications detaillees.', 3),
	(26, 1, 'Visite ininteressante', '2024-09-05', 'La visite etait trop basique et les vins ne m''ont pas convaincu. Dommage.', 2),
	(6, 26, 'Tres bien organise', '2024-09-02', 'Organisation impeccable, personnel sympathique. Les vins etaient de qualite.', 5),
	(38, 19, 'Visite agreable mais trop rapide', '2024-08-30', 'La visite etait sympathique, mais je trouve qu''elle manque de temps pour bien apprecier les differents vins.', 3),
	(5, 12, 'Un peu deçu', '2024-08-28', 'Le cadre est joli, mais les vins ne m''ont pas particulierement impressionne. De plus, la visite etait un peu courte.', 2),
	(48, 93, 'Vins exceptionnels', '2024-08-25', 'Degustation de vins exceptionnels, j''ai adore chaque instant. Une experience a refaire!', 5),
	(32, 78, 'Service parfait', '2024-08-22', 'Le service etait parfait, l''accueil chaleureux et les vins delicieux. Tres bon moment.', 5),
	(30, 86, 'Tres bon rapport qualite-prix', '2024-08-20', 'Une tres bonne experience pour un prix raisonnable. Les vins etaient de qualite et la visite interessante.', 4);

------------------------------------------------- APPARTIENT 2
INSERT INTO
	APPARTIENT_2 (idEtape, idRepas)
VALUES
	(1, 20),
	(2, 15),
	(3, 10),
	(4, 20),
	(5, 11),
	(6, 21),
	(7, 26),
	(8, 6),
	(9, 15),
	(10, 26),
	(11, 22),
	(12, 22),
	(13, 17),
	(14, 24),
	(15, 4),
	(16, 12),
	(17, 24),
	(18, 12),
	(19, 3),
	(20, 17),
	(21, 22),
	(22, 6),
	(23, 5),
	(24, 22),
	(25, 12),
	(26, 25),
	(27, 22),
	(28, 17),
	(29, 11),
	(30, 26),
	(31, 29),
	(32, 27),
	(33, 5),
	(34, 17),
	(35, 11),
	(36, 21),
	(37, 24),
	(38, 30),
	(39, 3),
	(40, 24),
	(41, 17),
	(42, 21),
	(43, 19),
	(44, 27),
	(45, 18),
	(46, 26),
	(47, 24),
	(48, 9),
	(49, 5),
	(50, 29),
	(51, 12),
	(52, 14),
	(53, 7),
	(54, 5),
	(55, 23),
	(56, 23),
	(57, 20),
	(58, 14),
	(59, 21),
	(60, 13),
	(61, 6),
	(62, 7),
	(63, 2),
	(64, 30),
	(65, 3),
	(66, 18),
	(67, 27),
	(68, 9),
	(69, 1),
	(70, 26),
	(71, 5),
	(72, 21),
	(73, 26),
	(74, 6),
	(75, 8),
	(76, 8),
	(77, 1),
	(78, 5),
	(79, 2),
	(80, 2),
	(81, 20),
	(82, 5),
	(83, 27),
	(84, 28),
	(85, 20),
	(86, 7),
	(87, 30),
	(88, 17),
	(89, 20),
	(90, 8),
	(91, 10),
	(92, 16),
	(93, 3),
	(94, 17),
	(95, 2),
	(96, 26),
	(97, 3),
	(98, 5),
	(99, 12),
	(100, 15),
	(87, 6),
	(95, 24),
	(23, 13),
	(90, 26),
	(74, 18),
	(1, 10),
	(63, 15),
	(63, 20),
	(77, 20),
	(22, 30),
	(62, 9),
	(51, 15),
	(14, 21),
	(35, 22),
	(97, 8),
	(77, 25),
	(27, 20),
	(92, 19),
	(25, 10),
	(97, 10),
	(15, 17),
	(12, 4),
	(44, 4),
	(39, 26),
	(90, 6),
	(35, 24),
	(82, 24),
	(94, 28),
	(99, 24),
	(58, 10),
	(26, 20),
	(8, 24),
	(35, 19),
	(33, 30),
	(33, 11),
	(41, 4),
	(18, 21),
	(82, 28),
	(66, 24),
	(36, 25),
	(11, 6),
	(24, 11),
	(9, 12),
	(13, 18),
	(90, 19),
	(84, 22),
	(91, 2),
	(20, 25),
	(9, 11),
	(35, 3);

------------------------------------------------- APPARTIENT 1
INSERT INTO
    APPARTIENT_1 (idEtape, idVisite)
VALUES
    (1, 16),
    (2, 19),
    (3, 12),
    (4, 1),
    (5, 17),
    (6, 15),
    (7, 14),
    (8, 4),
    (9, 2),
    (10, 3),
    (11, 15),
    (12, 6),
    (13, 9),
    (14, 5),
    (15, 8),
    (16, 7),
    (17, 6),
    (18, 18),
    (19, 7),
    (20, 9),
    (21, 19),
    (22, 8),
    (23, 9),
    (24, 5),
    (25, 1),
    (26, 2),
    (27, 14),
    (28, 10),
    (29, 3),
    (30, 2),
    (31, 8),
    (32, 18),
    (33, 10),
    (34, 13),
    (35, 3),
    (36, 20),
    (37, 3),
    (38, 15),
    (39, 2),
    (40, 6),
    (41, 20),
    (42, 1),
    (43, 10),
    (44, 3),
    (45, 5),
    (46, 13),
    (47, 12),
    (48, 3),
    (49, 11),
    (50, 3),
    (51, 9),
    (52, 12),
    (53, 7),
    (54, 15),
    (55, 2),
    (56, 17),
    (57, 5),
    (58, 13),
    (59, 8),
    (60, 6),
    (61, 15),
    (62, 14),
    (63, 11),
    (64, 17),
    (65, 2),
    (66, 11),
    (67, 7),
    (68, 7),
    (69, 8),
    (70, 3),
    (71, 9),
    (72, 16),
    (73, 2),
    (74, 4),
    (75, 13),
    (76, 9),
    (77, 20),
    (78, 13),
    (79, 17),
    (80, 20),
    (81, 13),
    (82, 14),
    (83, 14),
    (84, 6),
    (85, 4),
    (86, 12),
    (87, 16),
    (88, 7),
    (89, 14),
    (90, 14),
    (91, 9),
    (92, 15),
    (93, 8),
    (94, 15),
    (95, 1),
    (96, 4),
    (97, 17),
    (98, 20),
    (99, 11),
    (100, 4),
    (101, 10),
    (102, 2),
    (103, 18),
    (104, 5),
    (105, 3),
    (106, 1),
    (107, 3),
    (108, 6),
    (109, 4),
    (110, 5),
    (111, 6),
    (112, 7),
    (113, 8),
    (114, 9),
    (115, 5);
	
------------------------------------------------- DESCRIPTIONPANIER
INSERT INTO
	DESCRIPTIONPANIER (idSejour, idPanier, idhebergement, quantite, dateDebut, dateFin, nbAdultes, nbEnfants, nbChambresSimple, nbChambresDouble, nbChambresTriple, offrir, ecoffret, disponibilitehebergement)
VALUES
	(92, 36,  1, 1, '2025-06-19', '2025-06-22', '7', '3', '7', '1', '8',null,null,'False'),
	(76, 57,  1, 1, '2024-03-30', '2024-04-02', '10', '1', '10', '9', '1',null,null,'False'),
	(57, 48,  1, 1, '2025-03-14', '2025-03-17', '4', '8', '3', '5', '8',null,null,'False'),
	(71, 111, 1, 1, '2025-03-21', '2025-03-21', '2', '9', '6', '3', '10',null,null,'False'),
	(74, 2,   1, 1, '2024-11-10', '2024-11-11', '9', '5', '5', '2', '6',null,null,'False'),
	(14, 126, 1, 1, '2024-05-08', '2024-05-11', '9', '5', '2', '9', '2',null,null,'False'),
	(20, 129, 1, 1, '2025-01-29', '2025-01-29', '9', '9', '4', '4', '7',null,null,'False'),
	(24, 120, 1, 1, '2024-05-11', '2024-05-12', '2', '10', '3', '4', '5',null,null,'False'),
	(40, 47,  1, 1, '2024-08-15', '2024-08-16', '4', '10', '7', '2', '1',null,null,'False'),
	(94, 75,  1, 1, '2025-02-05', '2025-02-07', '8', '3', '2', '7', '5',null,null,'False'),
	(3, 121,  1, 1, '2025-06-04', '2025-06-05', '8', '8', '3', '3', '8',null,null,'False'),
	(92, 75,  1, 1, '2025-06-28', '2025-07-01', '7', '0', '7', '6', '2',null,null,'False'),
	(38, 4,   1, 1, '2025-07-10', '2025-07-13', '9', '6', '3', '5', '4',null,null,'False'),
	(90, 48,  1, 1, '2024-05-30', '2024-05-30', '0', '3', '5', '8', '8',null,null,'False'),
	(7, 138,  1, 1, '2024-12-27', '2024-12-28', '3', '9', '7', '5', '8',null,null,'False'),
	(18, 94,  1, 1, '2024-02-10', '2024-02-13', '1', '1', '1', '9', '2',null,null,'False'),
	(53, 26,  1, 1, '2024-10-20', '2024-10-23', '4', '1', '2', '5', '9',null,null,'False'),
	(53, 110, 1, 1, '2024-10-06', '2024-10-09', '1', '1', '2', '4', '8',null,null,'False'),
	(42, 34,   1, 1, '2023-12-25', '2023-12-28', '5', '7', '3', '7', '4',null,null,'False'),
	(72, 67,  1, 1, '2024-07-25', '2024-07-28', '10', '3', '5', '4', '0',null,null,'False'),
	(27, 14,  1, 1, '2025-07-18', '2025-07-18', '4', '3', '1', '3', '5',null,null,'False'),
	(84, 30,  1, 1, '2024-02-11', '2024-02-14', '7', '1', '2', '9', '2',null,null,'False'),
	(35, 14,  1, 1, '2025-02-25', '2025-02-27', '4', '3', '3', '9', '1',null,null,'False'),
	(77, 115, 1, 1, '2024-04-23', '2024-04-25', '8', '10', '1', '9', '9',null,null,'False'),
	(65, 83,  1, 1, '2024-08-26', '2024-08-29', '2', '5', '6', '4', '3',null,null,'False'),
	(17, 93,  1, 1, '2024-06-10', '2024-06-12', '3', '3', '5', '9', '5',null,null,'False'),
	(72, 60,  1, 1, '2025-11-13', '2025-11-16', '5', '0', '0', '6', '5',null,null,'False'),
	(49, 107, 1, 1, '2025-04-17', '2025-04-18', '5', '4', '8', '9', '6',null,null,'False'),
	(50, 43,  1, 1, '2024-10-29', '2024-10-31', '5', '8', '2', '4', '3',null,null,'False'),
	(21, 110, 1, 1, '2024-03-31', '2024-04-03', '4', '6', '2', '3', '2',null,null,'False'),
	(17, 117, 1, 1, '2024-11-29', '2024-12-01', '8', '10', '1', '7', '6',null,null,'False'),
	(47, 78,  1, 1, '2023-11-26', '2023-11-28', '8', '8', '0', '9', '2',null,null,'False'),
	(81, 85,  1, 1, '2025-06-28', '2025-06-30', '0', '8', '6', '9', '7',null,null,'False'),
	(61, 37,  1, 1, '2025-05-14', '2025-05-15', '3', '2', '4', '6', '7',null,null,'False'),
	(51, 106, 1, 1, '2025-10-12', '2025-10-15', '6', '7', '4', '4', '7',null,null,'False'),
	(85, 76,  1, 1, '2025-03-26', '2025-03-28', '1', '9', '2', '9', '1',null,null,'False'),
	(39, 42,  1, 1, '2025-09-29', '2025-10-01', '8', '8', '8', '4', '1',null,null,'False'),
	(15, 149, 1, 1, '2025-05-09', '2025-05-10', '5', '2', '7', '4', '4',null,null,'False'),
	(51, 127, 1, 1, '2023-12-01', '2023-12-04', '9', '6', '9', '6', '0',null,null,'False'),
	(52, 96,  1, 1, '2025-01-06', '2025-01-06', '4', '8', '5', '7', '4',null,null,'False'),
	(58, 40,  1, 1, '2024-11-20', '2024-11-21', '3', '10', '5', '0', '1',null,null,'False'),
	(68, 28,  1, 1, '2023-11-23', '2023-11-26', '3', '9', '5', '5', '4',null,null,'False'),
	(47, 101, 1, 1, '2025-05-27', '2025-05-29', '5', '5', '6', '9', '5',null,null,'False'),
	(5, 132,  1, 1, '2025-06-15', '2025-06-17', '7', '1', '8', '6', '9',null,null,'False'),
	(94, 125,  1, 1, '2024-10-24', '2024-10-26', '4', '4', '1', '5', '8',null,null,'False'),
	(90, 10,  1, 1, '2025-04-07', '2025-04-07', '1', '3', '3', '10', '7',null,null,'False'),
	(16, 100, 1, 1, '2024-03-10', '2024-03-10', '9', '9', '9', '2', '10',null,null,'False'),
	(64, 144, 1, 1, '2025-11-11', '2025-11-13', '8', '4', '3', '8', '7',null,null,'False'),
	(41, 34,   1, 1, '2024-04-06', '2024-04-06', '2', '7', '4', '6', '0',null,null,'False'),
	(75, 103, 1, 1, '2025-06-19', '2025-06-19', '7', '3', '7', '1', '8',null,null,'False'),
	(31, 130, 1, 1, '2024-03-30', '2024-03-30', '10', '1', '10', '9', '1',null,null,'False'),
	(96, 51,  1, 1, '2025-03-14', '2025-03-14', '4', '8', '3', '5', '8',null,null,'False'),
	(10, 46,  1, 1, '2025-03-21', '2025-03-24', '2', '9', '6', '3', '10',null,null,'False'),
	(60, 150, 1, 1, '2024-11-10', '2024-11-12', '9', '5', '5', '2', '6',null,null,'False'),
	(93, 84,  1, 1, '2024-05-08', '2024-05-08', '9', '5', '2', '9', '2',null,null,'False'),
	(96, 49,  1, 1, '2025-01-29', '2025-01-29', '9', '9', '4', '4', '7',null,null,'False'),
	(16, 35,  1, 1, '2024-05-11', '2024-05-11', '2', '10', '3', '4', '5',null,null,'False'),
	(42, 72,  1, 1, '2024-08-15', '2024-08-18', '4', '10', '7', '2', '1',null,null,'False'),
	(8, 112,  1, 1, '2025-02-05', '2025-02-05', '8', '3', '2', '7', '5',null,null,'False'),
	(64, 132, 1, 1, '2025-06-04', '2025-06-06', '8', '8', '3', '3', '8',null,null,'False'),
	(36, 123, 1, 1, '2025-06-28', '2025-06-29', '7', '0', '7', '6', '2',null,null,'False'),
	(2, 150,  1, 1, '2025-07-10', '2025-07-13', '9', '6', '3', '5', '4',null,null,'False'),
	(91, 34,  1, 1, '2024-05-30', '2024-05-31', '0', '3', '5', '8', '8',null,null,'False'),
	(29, 27,  1, 1, '2024-12-27', '2024-12-30', '3', '9', '7', '5', '8',null,null,'False'),
	(24, 45,  1, 1, '2024-02-10', '2024-02-11', '1', '1', '1', '9', '2',null,null,'False'),
	(57, 73,  1, 1, '2024-10-20', '2024-10-23', '4', '1', '2', '5', '9',null,null,'False'),
	(73, 45,  1, 1, '2024-10-06', '2024-10-08', '1', '1', '2', '4', '8',null,null,'False'),
	(60, 134,  1, 1, '2023-12-25', '2023-12-27', '5', '7', '3', '7', '4',null,null,'False'),
	(94, 98,  1, 1, '2024-07-25', '2024-07-27', '10', '3', '5', '4', '0',null,null,'False'),
	(93, 69,  1, 1, '2024-09-03', '2024-09-03', '9', '3', '8', '9', '9',null,null,'False'),
	(47, 56,  1, 1, '2025-07-18', '2025-07-20', '4', '3', '1', '3', '5',null,null,'False'),
	(86, 26,  1, 1, '2024-02-11', '2024-02-11', '7', '1', '2', '9', '2',null,null,'False'),
	(49, 71,  1, 1, '2025-02-25', '2025-02-26', '4', '3', '3', '9', '1',null,null,'False'),
	(23, 59,  1, 1, '2024-04-23', '2024-04-23', '8', '10', '1', '9', '9',null,null,'False'),
	(53, 70,  1, 1, '2024-08-26', '2024-08-29', '2', '5', '6', '4', '3',null,null,'False'),
	(22, 69,  1, 1, '2024-06-10', '2024-06-12', '3', '3', '5', '9', '5',null,null,'False'),
	(68, 129, 1, 1, '2025-11-13', '2025-11-16', '5', '0', '0', '6', '5',null,null,'False'),
	(21, 1,   1, 1, '2025-04-17', '2025-04-20', '5', '4', '8', '9', '6',null,null,'False'),
	(75, 38,  1, 1, '2024-10-29', '2024-10-29', '5', '8', '2', '4', '3',null,null,'False'),
	(68, 12,  1, 1, '2024-03-31', '2024-04-03', '4', '6', '2', '3', '2',null,null,'False'),
	(70, 124, 1, 1, '2024-11-29', '2024-11-30', '8', '10', '1', '7', '6',null,null,'False'),
	(40, 33,  1, 1, '2023-11-26', '2023-11-27', '8', '8', '0', '9', '2',null,null,'False'),
	(24, 52,  1, 1, '2025-06-28', '2025-06-29', '0', '8', '6', '9', '7',null,null,'False'),
	(27, 60,  1, 1, '2025-05-14', '2025-05-14', '3', '2', '4', '6', '7',null,null,'False'),
	(32, 113, 1, 1, '2025-10-12', '2025-10-13', '6', '7', '4', '4', '7',null,null,'False'),
	(32, 122, 1, 1, '2025-03-26', '2025-03-27', '1', '9', '2', '9', '1',null,null,'False'),
	(51, 85,  1, 1, '2025-09-29', '2025-10-02', '8', '8', '8', '4', '1',null,null,'False'),
	(2, 140,  1, 1, '2025-05-09', '2025-05-12', '5', '2', '7', '4', '4',null,null,'False'),
	(24, 72,  1, 1, '2023-12-01', '2023-12-02', '9', '6', '9', '6', '0',null,null,'False'),
	(20, 131, 1, 1, '2025-01-06', '2025-01-06', '4', '8', '5', '7', '4',null,null,'False'),
	(46, 150, 1, 1, '2024-11-20', '2024-11-23', '3', '10', '5', '0', '1',null,null,'False'),
	(16, 73,  1, 1, '2023-11-23', '2023-11-23', '3', '9', '5', '5', '4',null,null,'False'),
	(75, 132, 1, 1, '2025-05-27', '2025-05-27', '5', '5', '6', '9', '5',null,null,'False'),
	(23, 66,  1, 1, '2025-06-15', '2025-06-15', '7', '1', '8', '6', '9',null,null,'False'),
	(23, 148,  1, 1, '2024-10-24', '2024-10-24', '4', '4', '1', '5', '8',null,null,'False'),
	(94, 144, 1, 1, '2025-04-07', '2025-04-09', '1', '3', '3', '10', '7',null,null,'False'),
	(21, 79,  1, 1, '2024-03-10', '2024-03-13', '9', '9', '9', '2', '10',null,null,'False'),
	(18, 80,  1, 1, '2025-11-11', '2025-11-14', '8', '4', '3', '8', '7',null,null,'False'),
	(55, 54,   1, 1, '2024-04-06', '2024-04-09', '2', '7', '4', '6', '0',null,null,'False'),
	(33, 124, 1, 1, '2025-06-19', '2025-06-22', '7', '3', '7', '1', '8',null,null,'False'),
	(25, 34,  1, 1, '2024-03-30', '2024-04-01', '10', '1', '10', '9', '1',null,null,'False'),
	(2, 109,  1, 1, '2025-03-14', '2025-03-17', '4', '8', '3', '5', '8',null,null,'False'),
	(30, 130, 1, 1, '2025-03-21', '2025-03-23', '2', '9', '6', '3', '10',null,null,'False'),
	(66, 132, 1, 1, '2024-11-10', '2024-11-10', '9', '5', '5', '2', '6',null,null,'False'),
	(90, 67,  1, 1, '2024-05-08', '2024-05-08', '9', '5', '2', '9', '2',null,null,'False'),
	(72, 103, 1, 1, '2025-01-29', '2025-02-01', '9', '9', '4', '4', '7',null,null,'False'),
	(33, 18,  1, 1, '2024-05-11', '2024-05-14', '2', '10', '3', '4', '5',null,null,'False'),
	(60, 92,  1, 1, '2024-08-15', '2024-08-17', '4', '10', '7', '2', '1',null,null,'False'),
	(75, 55,  1, 1, '2025-02-05', '2025-02-05', '8', '3', '2', '7', '5',null,null,'False'),
	(43, 108, 1, 1, '2025-06-04', '2025-06-06', '8', '8', '3', '3', '8',null,null,'False'),
	(6, 81,   1, 1, '2025-06-28', '2025-07-01', '7', '0', '7', '6', '2',null,null,'False'),
	(20, 45,  1, 1, '2025-07-10', '2025-07-10', '9', '6', '3', '5', '4',null,null,'False'),
	(69, 78,  1, 1, '2024-05-30', '2024-06-01', '0', '3', '5', '8', '8',null,null,'False'),
	(46, 149, 1, 1, '2024-12-27', '2024-12-30', '3', '9', '7', '5', '8',null,null,'False'),
	(19, 113, 1, 1, '2024-02-10', '2024-02-11', '1', '1', '1', '9', '2',null,null,'False'),
	(73, 79,  1, 1, '2024-10-20', '2024-10-22', '4', '1', '2', '5', '9',null,null,'False'),
	(40, 9,   1, 1, '2024-10-06', '2024-10-07', '1', '1', '2', '4', '8',null,null,'False'),
	(5, 114,   1, 1, '2023-12-25', '2023-12-27', '5', '7', '3', '7', '4',null,null,'False'),
	(64, 113, 1, 1, '2024-07-25', '2024-07-27', '10', '3', '5', '4', '0',null,null,'False'),
	(29, 122, 1, 1, '2024-09-03', '2024-09-06', '9', '3', '8', '9', '9',null,null,'False'),
	(77, 134, 1, 1, '2025-07-18', '2025-07-20', '4', '3', '1', '3', '5',null,null,'False'),
	(66, 8,   1, 1, '2024-02-11', '2024-02-11', '7', '1', '2', '9', '2',null,null,'False'),
	(67, 69,  1, 1, '2025-02-25', '2025-02-26', '4', '3', '3', '9', '1',null,null,'False');
	
------------------------------------------------- DESCRIPTIONCOMMANDE
INSERT INTO
	DESCRIPTIONCOMMANDE (idSejour, idCommande, idHebergement, quantite, dateDebut, dateFin, nbAdultes, nbEnfants, nbChambresSimple, nbChambresDouble, nbChambresTriple, offrir, eCoffret,disponibilitehebergement)
VALUES
	(22,41,1,1,'2024-06-10','2024-06-12','3','3','5','9','5','False','False','False'),
	(64,43,1,1,'2025-06-04','2025-06-06','8','8','3','3','8','False','False','False'),
	(21,25,1,1,'2025-04-17','2025-04-20','5','4','8','9','6','False','False','False'),
	(64,6,1,1,'2024-07-25','2024-07-27','10','3','5','4','0','False','False','False'),
	(68,20,1,1,'2024-03-31','2024-04-03','4','6','2','3','2','False','False','False'),
	(2,12,1,1,'2025-07-10','2025-07-13','9','6','3','5','4','False','False','False'),
	(9,13,1,1,'2024-12-06','2024-12-08','1','0','1','0','0','False','False','False'),
	(29,3,1,1,'2024-12-27','2024-12-30','3','9','7','5','8','False','False','False'),
	(27,24,1,1,'2025-05-14','2025-05-14','3','2','4','6','7','False','False','False'),
	(32,4,1,1,'2025-10-12','2025-10-13','6','7','4','4','7','False','False','False'),
	(24,41,1,1,'2024-02-10','2024-02-11','1','1','1','9','2','False','False','False'),
	(57,1,1,1,'2024-10-20','2024-10-23','4','1','2','5','9','False','False','False'),
	(2,14,1,1,'2025-05-09','2025-05-12','5','2','7','4','4','False','False','False'),
	(24,11,1,1,'2023-12-01','2023-12-02','9','6','9','6','0','False','False','False'),
	(20,30,1,1,'2025-01-06','2025-01-06','4','8','5','7','4','False','False','False'),
	(46,9,1,1,'2024-11-20','2024-11-23','3','10','5','0','1','False','False','False'),
	(73,34,1,1,'2024-10-06','2024-10-08','1','1','2','4','8','False','False','False'),
	(66,29,1,1,'2024-02-11','2024-02-11','7','1','2','9','2','False','False','False'),
	(16,45,1,1,'2024-05-11','2024-05-11','2','10','3','4','5','False','False','False'),
	(2,2,1,1,'2024-12-04','2024-12-07','1','0','1','0','0','False','False','False'),
	(47,9,1,1,'2025-07-18','2025-07-20','4','3','1','3','5','False','False','False'),
	(2,37,1,1,'2024-12-05','2024-12-08','1','0','1','0','0','False','False','False'),
	(49,14,1,1,'2025-02-25','2025-02-26','4','3','3','9','1','False','False','False'),
	(23,16,1,1,'2024-04-23','2024-04-23','8','10','1','9','9','False','False','False'),
	(53,20,1,1,'2024-08-26','2024-08-29','2','5','6','4','3','False','False','False'),
	(19,2,1,1,'2024-02-10','2024-02-11','1','1','1','9','2','True','True','False'),
	(73,44,1,1,'2024-10-20','2024-10-22','4','1','2','5','9','True','True','False'),
	(40,1,1,1,'2024-10-06','2024-10-07','1','1','2','4','8','True','False','False'),
	(5,13,1,1,'2023-12-25','2023-12-27','5','7','3','7','4','True','True','False'),
	(96,5,1,1,'2025-01-29','2025-01-29','9','9','4','4','7','True','False','False'),
	(77,4,1,1,'2025-07-18','2025-07-20','4','3','1','3','5','True','False','False'),
	(67,41,1,1,'2025-02-25','2025-02-26','4','3','3','9','1','True','True','False'),
	(1,41,1,1,'2024-12-04','2024-12-06','1','0','1','0','0','True','True','False'),
	(1,19,1,1,'2024-12-05','2024-12-07','1','0','1','0','0','True','True','False'),
	(29,40,1,1,'2024-09-03','2024-09-06','9','3','8','9','9','True','False','False'),
	(42,12,1,1,'2024-08-15','2024-08-18','4','10','7','2','1','True','False','False'),
	(8,11,1,1,'2025-02-05','2025-02-05','8','3','2','7','5','True','False','False'),
	(36,20,1,1,'2025-06-28','2025-06-29','7','0','7','6','2','True','False','False'),
	(91,49,1,1,'2024-05-30','2024-05-31','0','3','5','8','8','True','False','False'),
	(60,47,1,1,'2023-12-25','2023-12-27','5','7','3','7','4','True','False','False'),
	(14,32,1,1,'2024-05-08','2024-05-11','9','5','2','9','2','False','False','False'),
	(40,3,1,1,'2024-08-15','2024-08-16','4','10','7','2','1','False','False','False'),
	(72,22,1,1,'2025-11-13','2025-11-16','5','0','0','6','5','False','False','False'),
	(50,24,1,1,'2024-10-29','2024-10-31','5','8','2','4','3','False','False','False'),
	(21,8,1,1,'2024-03-31','2024-04-03','4','6','2','3','2','False','False','False'),
	(81,50,1,1,'2025-06-28','2025-06-30','0','8','6','9','7','False','False','False'),
	(85,19,1,1,'2025-03-26','2025-03-28','1','9','2','9','1','False','False','False'),
	(15,43,1,1,'2025-05-09','2025-05-10','5','2','7','4','4','False','False','False'),
	(52,19,1,1,'2025-01-06','2025-01-06','4','8','5','7','4','False','False','False'),
	(68,27,1,1,'2023-11-23','2023-11-26','3','9','5','5','4','False','False','False'),
	(5,30,1,1,'2025-06-15','2025-06-17','7','1','8','6','9','False','False','False'),
	(20,18,1,1,'2025-07-10','2025-07-10','9','6','3','5','4','False','False','False'),
	(64,13,1,1,'2025-11-11','2025-11-13','8','4','3','8','7','False','False','False'),
	(41,8,1,1,'2024-04-06','2024-04-06','2','7','4','6','0','False','False','False'),
	(3,33,1,1,'2025-06-04','2025-06-05','8','8','3','3','8','False','False','False'),
	(92,12,1,1,'2025-06-28','2025-07-01','7','0','7','6','2','False','False','False'),
	(96,15,1,1,'2025-03-14','2025-03-14','4','8','3','5','8','False','False','False'),
	(10,4,1,1,'2025-03-21','2025-03-24','2','9','6','3','10','False','False','False'),
	(38,27,1,1,'2025-07-10','2025-07-13','9','6','3','5','4','False','False','False'),
	(7,22,1,1,'2024-12-27','2024-12-28','3','9','7','5','8','False','False','False'),
	(53,37,1,1,'2024-10-06','2024-10-09','1','1','2','4','8','False','False','False'),
	(27,16,1,1,'2025-07-18','2025-07-18','4','3','1','3','5','False','False','False'),
	(84,45,1,1,'2024-02-11','2024-02-14','7','1','2','9','2','False','False','False'),
	(35,48,1,1,'2025-02-25','2025-02-27','4','3','3','9','1','False','False','False'),
	(65,41,1,1,'2024-08-26','2024-08-29','2','5','6','4','3','False','False','False'),
	(6,4,1,1,'2025-06-28','2025-07-01','7','0','7','6','2','True','False','False'),
	(92,2,1,1,'2025-06-19','2025-06-22','7','3','7','1','8','True','True','False'),
	(76,32,1,1,'2024-03-30','2024-04-02','10','1','10','9','1','True','False','False'),
	(57,32,1,1,'2025-03-14','2025-03-17','4','8','3','5','8','True','True','False'),
	(71,17,1,1,'2025-03-21','2025-03-21','2','9','6','3','10','False','False','False'),
	(69,17,1,1,'2024-05-30','2024-06-01','0','3','5','8','8','True','True','False'),
	(46,16,1,1,'2024-12-27','2024-12-30','3','9','7','5','8','True','True','False'),
	(90,38,1,1,'2024-05-30','2024-05-30','0','3','5','8','8','True','True','False'),
	(18,38,1,1,'2024-02-10','2024-02-13','1','1','1','9','2','True','False','False'),
	(53,3,1,1,'2024-10-20','2024-10-23','4','1','2','5','9','True','True','False'),
	(94,16,1,1,'2025-04-07','2025-04-09','1','3','3','10','7','False','False','False'),
	(21,34,1,1,'2024-03-10','2024-03-13','9','9','9','2','10','False','False','False'),
	(18,34,1,1,'2025-11-11','2025-11-14','8','4','3','8','7','False','False','False'),
	(25,7,1,1,'2024-03-30','2024-04-01','10','1','10','9','1','False','False','False'),
	(66,2,1,1,'2024-11-10','2024-11-10','9','5','5','2','6','False','False','False'),
	(90,48,1,1,'2024-05-08','2024-05-08','9','5','2','9','2','False','False','False'),
	(60,5,1,1,'2024-08-15','2024-08-17','4','10','7','2','1','False','False','False'),
	(75,39,1,1,'2025-02-05','2025-02-05','8','3','2','7','5','False','False','False'),
	(75,38,1,1,'2025-05-27','2025-05-27','5','5','6','9','5','True','True','False'),
	(23,26,1,1,'2025-06-15','2025-06-15','7','1','8','6','9','True','False','False'),
	(23,24,1,1,'2024-10-24','2024-10-24','4','4','1','5','8','True','True','False'),
	(55,30,1,1,'2024-04-06','2024-04-06','2','7','4','6','0','True','False','False'),
	(33,27,1,1,'2025-06-19','2025-06-22','7','3','7','1','8','True','True','False'),
	(2,42,1,1,'2025-03-14','2025-03-17','4','8','3','5','8','True','True','False'),
	(30,45,1,1,'2025-03-21','2025-03-23','2','9','6','3','10','True','True','False'),
	(72,36,1,1,'2025-01-29','2025-02-01','9','9','4','4','7','True','False','False'),
	(33,13,1,1,'2024-05-11','2024-05-14','2','10','3','4','5','True','False','False'),
	(43,28,1,1,'2025-06-04','2025-06-06','8','8','3','3','8','True','True','False'),
	(94,45,1,1,'2024-07-25','2024-07-27','10','3','5','4','0','True','False','False'),
	(93,15,1,1,'2024-09-03','2024-09-03','9','3','8','9','9','True','True','False'),
	(86,10,1,1,'2024-02-11','2024-02-11','7','1','2','9','2','True','True','False'),
	(68,23,1,1,'2025-11-13','2025-11-16','5','0','0','6','5','True','True','False'),
	(75,4,1,1,'2024-10-29','2024-10-29','5','8','2','4','3','True','True','False'),
	(70,49,1,1,'2024-11-29','2024-11-30','8','10','1','7','6','True','False','False'),
	(40,20,1,1,'2023-11-26','2023-11-27','8','8','0','9','2','True','False','False'),
	(24,4,1,1,'2025-06-28','2025-06-29','0','8','6','9','7','True','True','False'),
	(32,42,1,1,'2025-03-26','2025-03-27','1','9','2','9','1','True','True','False'),
	(51,17,1,1,'2025-09-29','2025-10-02','8','8','8','4','1','True','True','False'),
	(42,16,1,1,'2023-12-25','2023-12-28','5','7','3','7','4','True','False','False'),
	(72,11,1,1,'2024-07-25','2024-07-28','10','3','5','4','0','True','True','False'),
	(77,20,1,1,'2024-04-23','2024-04-25','8','10','1','9','9','True','True','False'),
	(17,45,1,1,'2024-06-10','2024-06-12','3','3','5','9','5','True','False','False'),
	(74,5,1,1,'2024-11-10','2024-11-11','9','5','5','2','6','True','True','False'),
	(20,38,1,1,'2025-01-29','2025-01-29','9','9','4','4','7','True','True','False'),
	(24,5,1,1,'2024-05-11','2024-05-12','2','10','3','4','5','True','True','False'),
	(94,26,1,1,'2025-02-05','2025-02-07','8','3','2','7','5','True','True','False'),
	(49,2,1,1,'2025-04-17','2025-04-18','5','4','8','9','6','True','True','False'),
	(17,36,1,1,'2024-11-29','2024-12-01','8','10','1','7','6','True','False','False'),
	(47,18,1,1,'2023-11-26','2023-11-28','8','8','0','9','2','True','False','False'),
	(61,33,1,1,'2025-05-14','2025-05-17','3','2','4','6','7','True','True','False'),
	(51,45,1,1,'2025-10-12','2025-10-15','6','7','4','4','7','True','False','False'),
	(39,25,1,1,'2025-09-29','2025-10-01','8','8','8','4','1','True','True','False'),
	(51,1,1,1,'2023-12-01','2023-12-04','9','6','9','6','0','True','False','False'),
	(58,44,1,1,'2024-11-20','2024-11-21','3','10','5','0','1','True','False','False'),
	(47,27,1,1,'2025-05-27','2025-05-29','5','5','6','9','5','True','True','False'),
	(94,14,1,1,'2024-10-24','2024-10-26','4','4','1','5','8','True','True','False'),
	(90,19,1,1,'2025-04-07','2025-04-07','1','3','3','10','7','True','False','False'),
	(16,27,1,1,'2024-03-10','2024-03-10','9','9','9','2','10','True','False','False'),
	(75,17,1,1,'2025-06-19','2025-06-19','7','3','7','1','8','True','False','False'),
	(31,36,1,1,'2024-03-30','2024-03-30','10','1','10','9','1','True','True','False'),
	(60,30,1,1,'2024-11-10','2024-11-12','9','5','5','2','6','True','True','False'),
	(93,30,1,1,'2024-05-08','2024-05-08','9','5','2','9','2','True','True','False'),
	(16,41,1,1,'2023-11-23','2023-11-23','3','9','5','5','4','True','False','False'),
	(1,51,15,1,'2024-12-23','2024-12-24','2','0','0','1','0','true','true','false');
	
Insert into mange1 (IDDESCRIPTIONCOMMANDE, IDREPAS)
values
(1,	26),
(2,	8),
(3,	10),
(4,	26),
(5,	3),
(6,	19),
(7,	19),
(8,	1),
(9,	22),
(10,	27),
(11,	26),
(12,	9),
(13,	5),
(14,	21),
(15,	26),
(16,	27),
(17,	18),
(18,	21),
(19,	10),
(20,	16),
(21,	14),
(22,	3),
(23,	28),
(24,	13),
(25,	17),
(26,	10),
(27,	13),
(28,	24),
(29,	5),
(30,	29),
(31,	17),
(32,	29),
(33,	27),
(34,	19),
(35,	8),
(36,	7),
(37,	25),
(38,	30),
(39,	23),
(40,	20),
(41,	14),
(42,	27),
(43,	17),
(44,	19),
(45,	29),
(46,	5),
(47,	15),
(48,	21),
(49,	20),
(50,	7),
(51,	23),
(52,	26),
(53,	15),
(54,	27),
(55,	6),
(56,	4),
(57,	17),
(58,	5),
(59,	4),
(60,	6),
(61,	28),
(62,	15),
(63,	26),
(64,	21),
(65,	4),
(66,	18),
(67,	23),
(68,	10),
(69,	21),
(70,	12),
(71,	15),
(72,	19),
(73,	11),
(74,	23),
(75,	11),
(76,	13),
(77,	14),
(78,	2),
(79,	18),
(80,	5),
(81,	15),
(82,	23),
(83,	4),
(84,	28),
(85,	16),
(86,	2),
(87,	30),
(88,	15),
(89,	9),
(90,	11),
(91,	2),
(92,	5),
(93,	11),
(94,	30),
(95,	14),
(96,	20),
(97,	20),
(98,	24),
(99,	5),
(100,	1),
(101,	8),
(102,	12),
(103,	24),
(104,	12),
(105,	14),
(106,	23),
(107,	9),
(108,	9),
(109,	16),
(110,	4),
(111,	1),
(112,	11),
(113,	11),
(114,	1),
(115,	9),
(116,	17),
(117,	3),
(118,	27),
(119,	7),
(120,	19),
(121,	11),
(122,	16),
(123,	13),
(124,	4),
(125,	21),
(126,	30),
(127,	15),
(128,	20),
(129,	10),
(129, 	20);


Insert into ASSOCIATION_39 (IDDESCRIPTIONPANIER, IDREPAS)
values
(1,	26),
(2,	8),
(3,	10),
(4,	26),
(5,	3),
(6,	19),
(7,	19),
(8,	1),
(9,	22),
(10,	27),
(11,	26),
(12,	9),
(13,	5),
(14,	21),
(15,	26),
(16,	27),
(17,	18),
(18,	21),
(19,	10),
(20,	16),
(21,	14),
(22,	3),
(23,	28),
(24,	13),
(25,	17),
(26,	10),
(27,	13),
(28,	24),
(29,	5),
(30,	29),
(31,	17),
(32,	29),
(33,	27),
(34,	19),
(35,	8),
(36,	7),
(37,	25),
(38,	30),
(39,	23),
(40,	20),
(41,	14),
(42,	27),
(43,	17),
(44,	19),
(45,	29),
(46,	5),
(47,	15),
(48,	21),
(49,	20),
(50,	7),
(51,	23),
(52,	26),
(53,	15),
(54,	27),
(55,	6),
(56,	4),
(57,	17),
(58,	5),
(59,	4),
(60,	6),
(61,	28),
(62,	15),
(63,	26),
(64,	21),
(65,	4),
(66,	18),
(67,	23),
(68,	10),
(69,	21),
(70,	12),
(71,	15),
(72,	19),
(73,	11),
(74,	23),
(75,	11),
(76,	13),
(77,	14),
(78,	2),
(79,	18),
(80,	5),
(81,	15),
(82,	23),
(83,	4),
(84,	28),
(85,	16),
(86,	2),
(87,	30),
(88,	15),
(89,	9),
(90,	11),
(91,	2),
(92,	5),
(93,	11),
(94,	30),
(95,	14),
(96,	20),
(97,	20),
(98,	24),
(99,	5),
(100,	1),
(101,	8),
(102,	12),
(103,	24),
(104,	12),
(105,	14),
(106,	23),
(107,	9),
(108,	9),
(109,	16),
(110,	4),
(111,	1),
(112,	11),
(113,	11),
(114,	1),
(115,	9),
(116,	17),
(117,	3),
(118,	27),
(119,	7),
(120,	19),
(121,	11),
(122,	16),
(123,	13);

CREATE VIEW v_descriptioncommande AS (
	SELECT
		descriptioncommande.*,
		CASE
			WHEN descriptioncommande.codepromoutilise is not null THEN 0
			ELSE (
			    (
		                COALESCE(sejour.nouveauprixsejour, COALESCE(sejour.prixsejour, 0)) +
			        COALESCE(hebergement.prixhebergement, 0) +
		                SUM(COALESCE(repas.prixrepas, 0)) +
		                SUM(COALESCE(activite.prixactivite, 0))
		            ) * (descriptioncommande.nbadultes + descriptioncommande.nbenfants) +
		            (descriptioncommande.nbchambressimple * 75) +
		            (descriptioncommande.nbchambresdouble * 100) +
		            (descriptioncommande.nbchambrestriple * 125) +
	                    (CASE
	                        WHEN descriptioncommande.offrir AND NOT descriptioncommande.ecoffret THEN 5
	                        ELSE 0
	                    END) * descriptioncommande.quantite
		        )
                END AS prix
	FROM descriptioncommande
		LEFT JOIN mange1 mange ON descriptioncommande.iddescriptioncommande = mange.iddescriptioncommande
		LEFT JOIN repas ON mange.idrepas = repas.idrepas
		LEFT JOIN association_40 a ON descriptioncommande.iddescriptioncommande = a.iddescriptioncommande
		LEFT JOIN activite ON a.idactivite = activite.idactivite
		LEFT JOIN sejour ON descriptioncommande.idsejour = sejour.idsejour
		LEFT JOIN hebergement ON descriptioncommande.idhebergement = hebergement.idhebergement
	GROUP BY
		descriptioncommande.iddescriptioncommande,
		sejour.prixsejour,
		sejour.nouveauprixsejour,
		hebergement.prixhebergement
);

CREATE VIEW v_descriptionpanier AS (
	SELECT
		descriptionpanier.*,
		CASE
			WHEN descriptionpanier.codepromoutilise is not null THEN 0
			ELSE (
			    (
		                COALESCE(sejour.nouveauprixsejour, COALESCE(sejour.prixsejour, 0)) +
			        COALESCE(hebergement.prixhebergement, 0) +
		                SUM(COALESCE(repas.prixrepas, 0)) +
		                SUM(COALESCE(activite.prixactivite, 0))
		            ) * (descriptionpanier.nbadultes + descriptionpanier.nbenfants) +
		            (descriptionpanier.nbchambressimple * 75) +
		            (descriptionpanier.nbchambresdouble * 100) +
		            (descriptionpanier.nbchambrestriple * 125) +
	                    (CASE
	                        WHEN descriptionpanier.offrir AND NOT descriptionpanier.ecoffret THEN 5
	                        ELSE 0
	                    END) * descriptionpanier.quantite
		        )
                END AS prix
	FROM descriptionpanier
		LEFT JOIN association_39 mange ON descriptionpanier.iddescriptionpanier = mange.iddescriptionpanier
		LEFT JOIN repas ON mange.idrepas = repas.idrepas
		LEFT JOIN association_38 a ON descriptionpanier.iddescriptionpanier = a.iddescriptionpanier
		LEFT JOIN activite ON a.idactivite = activite.idactivite
		LEFT JOIN sejour ON descriptionpanier.idsejour = sejour.idsejour
		LEFT JOIN hebergement ON descriptionpanier.idhebergement = hebergement.idhebergement
	GROUP BY
		descriptionpanier.iddescriptionpanier,
		sejour.prixsejour,
		sejour.nouveauprixsejour,
		hebergement.prixhebergement
);

CREATE VIEW v_commande AS (
	SELECT
		commande.*,
		sum(dp.prix) AS prix
	FROM commande
		JOIN v_descriptioncommande dp ON commande.idcommande = dp.idcommande
	GROUP BY
		commande.idcommande
);

create view v_etatcommande_sejour as (
	select etatcommande, datecommande, titresejour from commande c
	join descriptioncommande d on c.idcommande = d.idcommande 
	join sejour s on d.idsejour = s.idsejour
);

create view v_nbsejour_vendu as (
select datecommande, count(titresejour) from commande c
join descriptioncommande d on c.idcommande = d.idcommande 
join sejour s on d.idsejour = s.idsejour
where etatcommande = 'Paiement validé'
group by datecommande
);

create view v_nbsejour_vendu_vignoble as (
select LIBELLECATEGORIEVIGNOBLE, datecommande, count(titresejour) from commande c
join descriptioncommande d on c.idcommande = d.idcommande 
join sejour s on d.idsejour = s.idsejour
join categorievignoble cv on s.idcategorievignoble = cv.idcategorievignoble
where etatcommande = 'Paiement validé'
group by LIBELLECATEGORIEVIGNOBLE, datecommande
);

create view v_datecommande as
select datecommande from commande;

create view v_etatcommande_sejour_localite as (
	select libellecategorievignoble, etatcommande, datecommande, titresejour,'France' as "Pays" from commande c
	join descriptioncommande d on c.idcommande = d.idcommande 
	join sejour s on d.idsejour = s.idsejour
	join categorievignoble cv on s.idcategorievignoble = cv.idcategorievignoble
);
